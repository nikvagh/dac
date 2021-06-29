<div class="row text-right">
	<div class="col-md-12 text-center mb-20">
		<a href="#" onClick="load_membership_add()" class="btn-sm btn-secondary">Purchase New Package <i class="fa fa-plus-circle"></i></a>
	</div>
</div>
<ul class="membership_ul">
	<?php foreach($list as $key=>$val){ ?>
		<li row-id="<?php echo $val->id; ?>">
			<div class="row flex-row">
				<div class="col-md-9">
					<?php echo $val->package_name; ?>
					<br/>
					<i class="fa fa-calendar"></i> <?php echo date('M d, Y H:i',strtotime($val->start_date)) .' - '.date('M d, Y H:i',strtotime($val->end_date)); ?>
				</div>
				<?php
					if($val->validity_status == 'Ongoing'){
						$status_theme = "success";
						$bg_theme = "#5cb85c";
					}elseif($val->validity_status == 'Pending'){
						$status_theme = "primary";
						$bg_theme = "#00aeef";
					}elseif($val->validity_status == 'Expired'){
						$status_theme = "danger";
						$bg_theme = "#d9534f";
					}
				?>
				<div class="col-md-3 status-box text-white" style="background:<?php echo $bg_theme; ?>;">
					<a class="btn btn-sm btn-pill btn-<?php echo $status_theme; ?>">
						<?php echo $val->validity_status; ?>
					</a>
				</div>
			</div>
		</li>
	<?php } ?>
</ul>

<!-- <ul>
  <li>
    <input id="c1" type="checkbox">
    <label for="c1">Checkbox</label>
  </li>
  <li>
    <input id="c2" type="checkbox" checked>
    <label for="c2">Checkbox</label>
  </li>
  <li>
    <input id="r1" type="radio" name="radio" value="1">
    <label for="r1">Radio</label>
  <li>
    <input id="s2" type="checkbox" class="switch" checked>
    <label for="s2">Switch</label>
  </li>
</ul>

<ul>
  <li>
    <input id="c1d" type="checkbox" disabled>
    <label for="c1d">Checkbox</label>
  </li>
  <li>
    <input id="c2d" type="checkbox" checked disabled>
    <label for="c2d">Checkbox</label>
  </li>
  <li>
    <input id="r1d" type="radio" name="radiod" value="1" disabled>
    <label for="r1d">Radio</label>
  </li>
  <li>
    <input id="r2d" type="radio" name="radiod" value="2" checked disabled>
    <label for="r2d">Radio</label>
  </li>
  <li>
    <input id="s1d" type="checkbox" class="switch" disabled>
    <label for="s1d">Switch</label>
  </li>
  <li>
    <input id="s2d" type="checkbox" class="switch" checked disabled>
    <label for="s2d">Switch</label>
  </li>
</ul> -->

<br/>
<div class="pagination_wrapper membership_pagination">
	<?php echo $pagination; ?>
</div>