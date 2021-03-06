<input type="hidden" id="posy" value="<?php echo $posy; ?>" />
<div class="container-full mt50">
	<div class="navbar-left col-md-2 pt15" id="page-sidebar">
		<h4>Mes comptes</h4>
		<ul class="nav nav-pills nav-stacked">
	      <?php
	      	if(!empty($TComptes)) {
	      		foreach($TComptes as $c) {
	      			$c->signe();
	      			?>
			<li <?php if($id == $c->rowid) echo 'class="active"'; ?>>
				<a href="?action=view&id=<?php echo $c->rowid; ?>">
					<div class="col-md-8 nopad">
						<span class="glyphicon glyphicon-chevron-right ml010"></span> <?php echo $c->label; ?>
					</div>
					<div class="col-md-4 nopad text-right">
						<span class="badge <?php echo $c->trans_signe; ?>"><?php echo view_price($c->amount_day); ?></span>
					</div>
					<div class="clear"></div>
				</a>
			</li>
	      			<?php
	      		}
	      	}
	      ?>
		</ul>
	</div>
	
	<div class="col-md-10 pt15" id="event-list">
	<?php
		if(!empty($id)) {
	?>
		<input type="hidden" id="compteid" value="<?php echo $id; ?>" />
		<input type="hidden" id="yearid" value="<?php echo $year; ?>" />
		<div class="col-md-8">
			<?php foreach($TFilterYears as $y): ?>
				<a class="col-md-1 text-center bloc-grey<?php if($year == $y)echo ' active'; ?>" href="?id=<?php echo $id; ?>&year=<?php echo $y; ?>"><?php echo $y ?></a>
			<?php endforeach; ?>
		</div>
		<div class="col-md-4 text-right titleday">
			Caisse fin d'année <?php echo ($year-1).' : '.view_price($compte->amount_before); ?> €
		</div>
		<div class="clear"></div>
		<div class="col-md-2" id="waiting-payments">
			<div class="day waiting">
				<div class="title">
					<span class="glyphicon glyphicon-time"></span> Paiements en attentes
				</div>
				<div class="mt15"></div>
				<?php foreach($TWaitingPayments as $current_payment): ?>
			<div class="event">
				<div class="col-md-8 nopad">
					<h6><?php echo $current_payment->show(); ?></h6>
					<input type="hidden" name="current_date" value="">
				</div>
				<div class="col-md-4 nopad text-right">
					<span class="badge <?php if($current_payment->amount > 0) echo 'backgreen'; elseif($current_payment->amount == 0) echo ' backgrey'; else echo 'backred'; ?>">
						<?php echo view_price($current_payment->amount); ?>
					</span>
						<input type="hidden" name="label" value="<?php echo $current_payment->label; ?>"/>
						<input type="hidden" name="date_facture" value="<?php echo $current_payment->date_facture; ?>"/>
						<input type="hidden" name="amount" value="<?php echo $current_payment->amount; ?>"/>
						<input type="hidden" name="rowid" value="<?php echo $current_payment->rowid; ?>"/>
						<input type="hidden" name="datep" value=""/>
						<input type="hidden" name="mode" value="<?php echo $current_payment->mode; ?>"/>
						<input type="hidden" name="status" value="<?php echo $current_payment->status; ?>"/>
						<input type="hidden" name="tva" value="<?php echo $current_payment->tva; ?>"/>
						<input type="hidden" name="provision" value="<?php echo $current_payment->provision; ?>"/>
						<input type="hidden" name="fk_categcomptable" value="<?php echo $current_payment->fk_categcomptable; ?>"/>
				</div>
				<div class="clear nopad"></div>
			</div>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="col-md-10 nopad">
					<?php
						// Start date
						$date = strtotime(date($year.'-01-01'));
						// End date
						$end_date = strtotime(date($year.'-12-31'));
						
						// Instanciation
						$num_day=$i=(int) date('N',$date);
						$restart=true;
						$total_caisse = $compte->amount_before;
						
						while ($date <= $end_date) {
							$month = (int) date('m',$date);
							$dateformat = $TDays[$num_day].' '.date('d',$date);
							$dateformatbis = date('m/d/Y',$date);
							$current_year = date('Y',$date);
							$current_month = date('m',$date);
							$current_day = date('d',$date);
							if(!empty($TAmount[$current_year][$current_month][$current_day])) {
								$amountday = $TAmount[$current_year][$current_month][$current_day]['current'];
							}else {
								$amountday = 0;
							}
							$total_caisse += $amountday;
							
							// Gestion affichage calendrier
							if($i==1 || ($restart && $i<7)) {
								if($restart) {
									echo '<div class="clear"></div><div class="titleday text-left cold-md-12" colspan=6>'.$TMonths[$month].' '.$year.'</div>';
									for($j=1;$j<$i;$j++) {
										echo '<div class="col-md-2"></div>';
									}
								}
								$restart=false;
							}
							if($i!=7){
					?>
					<div class="day nopad<?php if(in_array($num_day, array(6,7))) echo ' weekend'; if(date('Ymd',$date) == date('Ymd',time())) echo ' current'; ?> col-md-2">
						<div class="col-md-6">
							<?php echo $dateformat; ?>
							<input type="hidden" name="current_date" value="<?php echo $dateformatbis; ?>">
						</div>
						<div class="col-md-6 amount text-right<?php if($total_caisse>0) echo ' backgreen'; elseif($total_caisse == 0) echo ' backgrey'; else echo ' backred'; ?>">
							<?php echo view_price($total_caisse); ?>
						</div>
						
						<div class="amountmonth clear text-right">
							<span class="glyphicon glyphicon-refresh"></span> <?php echo view_price($amountday); ?>
						</div>
						
						<?php
						
						/**
						 * On boucle la liste des payments pour cette date
						 * 
						 */
							if(!empty($TPayments[$current_year][$current_month][$current_day])) {
								foreach($TPayments[$current_year][$current_month][$current_day] as $current_payment) {
									?>
									
						<div class="event<?php if($current_payment->status > 0) echo ' validate'; ?>">
							<div class="col-md-6 nopad">
								<h6><?php echo $current_payment->show(); ?></h6>
							</div>
							<div class="col-md-6 nopad text-right">
								<span class="badge <?php if($current_payment->amount > 0) echo 'backgreen'; elseif($current_payment->amount == 0) echo ' backgrey';  else echo 'backred'; ?>">
									<?php echo view_price($current_payment->amount); ?>
								</span>
								<input type="hidden" name="label" value="<?php echo $current_payment->label; ?>"/>
								<input type="hidden" name="date_facture" value="<?php echo $current_payment->date_facture; ?>"/>
								<input type="hidden" name="amount" value="<?php echo $current_payment->amount; ?>"/>
								<input type="hidden" name="rowid" value="<?php echo $current_payment->rowid; ?>"/>
								<input type="hidden" name="datep" value="<?php echo $current_payment->datep; ?>"/>
								<input type="hidden" name="mode" value="<?php echo $current_payment->mode; ?>"/>
								<input type="hidden" name="status" value="<?php echo $current_payment->status; ?>"/>
								<input type="hidden" name="tva" value="<?php echo $current_payment->tva; ?>"/>
								<input type="hidden" name="provision" value="<?php echo $current_payment->provision; ?>"/>
								<input type="hidden" name="fk_categcomptable" value="<?php echo $current_payment->fk_categcomptable; ?>"/>
							</div>
							<div class="clear nopad"></div>
						</div>
									
									<?php
								}
							}
						?>
					</div>
					<?php
							}
							$i++;
							if(date('Y-m-d',$date) == date('Y-m-t',$date)){
								for($j=$i;$j<=7;$j++) {
                                    echo '<div class="col-md-2"></div>';
								}
								$restart=true;
							}
                            if($i>7) {
                                echo '<div class="clear"></div>';
                                $i=1;
                            }
							$date = strtotime("+1 day", $date);
							$num_day = date('N',$date);
						}
					?>
		</div>
		<?php 
			}
		?>
	</div>
</div>

<!-- Modal EDIT -->
<div class="modal fade" id="editModal" role="dialog" aria-labelledby="Edition d'un paiement">
	<form method="post" action="">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editer un paiement</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="action" value="edit" />
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<input type="hidden" name="fk_bank" value="<?php echo $id; ?>" />
					<input type="hidden" name="rowid" value="" />
					<input type="hidden" name="datep" value="" />
					<input type="hidden" name="posy" value="" />
					<div class="col-md-3">
					   <strong>Modes de paiements</strong>
					</div>
					<div class="col-md-9">
					<?php
						foreach($payment->TTypeTrad as $key => $label) {
							echo '<input type="radio" class="special-ui" id="mode'.$key.'" name="mode" value="'.$key.'" /><label for="mode'.$key.'" class="col-md-5">'.$label.'</label>';
						}
					?>
					</div>
					<div class="row" style="padding:10px">&nbsp;</div>
					<div class="col-md-3">
						<label for="label">Denomination</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="label" value="" />
					</div>
					<div class="col-md-3">
						<label for="amount">Montant</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="amount" value="" />
					</div>
					<div class="col-md-3">
						<label for="status-1">&nbsp;</label>
					</div>
					<div class="col-md-9">
						<label for="status-edit">Facturé acquité</label>
						<input class="special-ui" type="checkbox" name="status" id="status-edit" value="1" />
					</div>
					<div class="col-md-3">
						<strong>Taux de TVA</strong>
					</div>
					<div class="col-md-9">
						<input type="radio" class="special-ui" id="tva200" name="tva" value="200" /><label for="tva200">20</label>
						<input type="radio" class="special-ui" id="tva100" name="tva" value="100" /><label for="tva100">10</label>
						<input type="radio" class="special-ui" id="tva55" name="tva" value="55" /><label for="tva55">5.5</label>
						<input type="radio" class="special-ui" id="tva0" name="tva" value="0" /><label for="tva0">0</label>
					</div>
					<div class="col-md-3">
						<strong>Provision</strong>
					</div>
					<div class="col-md-9">
						<label for="provision-edit">Oui</label>
						<input class="special-ui" type="checkbox" name="provision" id="provision-edit" value="1" />
					</div>
					<div class="row" style="padding:10px">&nbsp;</div>
					<div class="col-md-3">
						<label for="edit-date-facture">Date réel de la Facture</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="date_facture" id="edit-date-facture" value="" />
					</div>
					<div class="row" style="padding:10px">&nbsp;</div>
					<div class="col-md-3">
						<label for="fk_categcomptable_edit">Catégorie comptable</label>
					</div>
					<div class="col-md-9">
						<select class="special-select" name="fk_categcomptable" id="fk_categcomptable_edit" style="width:500px;">
							<option value="">&nbsp;</option>
						<?php
						if(!empty($TCompta)) {
							foreach($TCompta as $categ){
								$isParent = (!in_array($categ->rowid,$TNotAllowed) && empty($categ->fk_parent) || $categ->fk_parent == TRESO_EX_CATEG_ID);
								if($isParent) {
									echo '<option value="'.$categ->rowid.'" disabled="disabled">'.$categ->show().'</option>';
								}else {
									echo '<option value="'.$categ->rowid.'">'.$categ->show().'</option>';
								}
							}
						}
						?>
						</select>
					</div>
					<div class="clear"></div>
				</div>
				<div class="modal-footer">
					<input type="submit" name="valid" class="btn btn-primary" value="Valider"/>
					<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="delete-event">Supprimer</button>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- Modal NEW -->
<div class="modal fade" id="newModal" role="dialog" aria-labelledby="Nouveau paiement">
	<form method="post">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Créer un paiement</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="action" value="new" />
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<input type="hidden" name="fk_bank" value="<?php echo $id; ?>" />
					<input type="hidden" name="payment" value="" />
					<input type="hidden" name="posy" value="" />
					<div class="col-md-3">
						<label for="datep">Date</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="datep" id="new-date" value="" />
					</div>
					<div class="row" style="padding:10px">&nbsp;</div>
					<div class="col-md-3">
					   <strong>Modes de paiements</strong>
					</div>
					<div class="col-md-9">
					<?php
						foreach($payment->TTypeTrad as $key => $label) {
							echo '<input type="radio" class="special-ui" id="nmode'.$key.'" name="mode" value="'.$key.'" /><label for="nmode'.$key.'" class="col-md-5">'.$label.'</label>';
						}
					?>
					</div>
					<div class="row" style="padding:10px">&nbsp;</div>
					<div class="col-md-3">
						<label for="label">Denomination</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="label" value="" />
					</div>
					<div class="col-md-3">
						<label for="amount">Montant</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="amount" value="" />
					</div>
					<div class="col-md-3">
						<label for="status-1">&nbsp;</label>
					</div>
					<div class="col-md-9">
						<label for="status-new" class="col-md-8">Facturé acquité</label>
						<input class="special-ui" type="checkbox" name="status" id="status-new"/>
					</div>
					<div class="col-md-3">
						<strong>Taux de TVA</strong>
					</div>
					<div class="col-md-9">
						<input type="radio" class="special-ui" id="tva20-new" name="tva" value="200" /><label for="tva20-new">20</label>
						<input type="radio" class="special-ui" id="tva10-new" name="tva" value="100" /><label for="tva10-new">10</label>
						<input type="radio" class="special-ui" id="tva5-new" name="tva" value="55" /><label for="tva5-new">5.5</label>
						<input type="radio" class="special-ui" id="tva0-new" name="tva" value="0" /><label for="tva0-new">0</label>
					</div>
					<div class="row" style="padding:10px">&nbsp;</div>
					<div class="col-md-3">
						<strong>Provision</strong>
					</div>
					<div class="col-md-9">
						<label for="provision-new">Oui</label>
						<input class="special-ui" type="checkbox" name="provision" id="provision-new" value="1" />
					</div>
					<div class="row" style="padding:10px">&nbsp;</div>
					<div class="col-md-3">
						<label for="new-date-facture">Date réel de la Facture</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="date_facture" id="new-date-facture" value="" />
					</div>
					<div class="row" style="padding:5px">&nbsp;</div>
					<div class="col-md-3">
						<label for="fk_categcomptable_new">Catégorie comptable</label>
					</div>
					<div class="col-md-9">
						<select class="special-select" name="fk_categcomptable" id="fk_categcomptable_new" style="width:500px;">
							<option value="">&nbsp;</option>
						<?php
						if(!empty($TCompta)) {
							foreach($TCompta as $categ){
								$isParent = (!in_array($categ->rowid,$TNotAllowed) && empty($categ->fk_parent) || $categ->fk_parent == TRESO_EX_CATEG_ID);
								if($isParent) {
									echo '<option value="'.$categ->rowid.'" disabled="disabled">'.$categ->show().'</option>';
								}else {
									echo '<option value="'.$categ->rowid.'">'.$categ->show().'</option>';
								}
							}
						}
						?>
						</select>
					</div>
					<div class="clear"></div>
				</div>
				<div class="modal-footer">
					<input type="submit" name="valid" class="btn btn-primary" value="Valider"/>
					<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				</div>
			</div>
		</div>
	</form>
</div>