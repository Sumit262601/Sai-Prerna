<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul class="nav-links">
                <li class="label">MENU</li>

                <li class=""><a class="nvlnk" href="<?= base_url('web-admin/dashboard'); ?>"><i class="ti-home"></i> Dashboard</a></li>

				<?php if(isset($tab)){ 
                    foreach($tab as $grp => $val){
                        // print_r($tab);
                ?>
				    <li class="opn-prn">
                        <a class="sidebar-sub-toggle">
                            <i class="<?=$val['icon'];?>"></i> 
                            <?=$grp;?> 
                            <span class="sidebar-collapse-icon ti-angle-down"></span>
                        </a>
                        <ul class="mm-show">
				    		<?php asort($val['menu']); // asort for ascending order according by value! 
                                foreach($val['menu'] as $name => $url){ ?>
				    		<li>
                                <a href="<?= site_url('web-admin/'.$url); ?>">
                                    <i class="ti-book"></i><?=ucfirst($name);?>
                                </a>
                            </li>
				    		<?php } ?>
				    	</ul>
                    </li>
				<?php } } ?>

				<li><a href="<?= site_url('web-admin'); ?>"><i class="ti-power-off"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<div id="toast-erromsg"></div>









