
<div class="panel-banner white-block min-banner for-panel-menu d-none d-xl-block">
    <div class="panel-menu panel-menu-move">
        
        <?php if(Auth::user()){ ?>
        <div class="link">
            <a class="{{ (request()->is('/user') OR request()->is('/user/channels')) ? 'active' : '' }}" href="<?php echo route('user.channels') ?>">
                <div class="icon fill-inherit">
                    <img src="account/images/m1.svg"/>
                    <?php //include 'images/m1.svg'; ?>
                </div>
                <p><? echo __('text.text_113') ?></p>
            </a>
        </div>

        <div class="link">
            <a class="{{ (request()->is('/user/publications')) ? 'active' : '' }}" href="<?php echo route('user.publications') ?>">
                <div class="icon fill-inherit">
                    <img src="account/images/m1.svg"/>
                    <?php //include 'images/m1.svg'; ?>
                </div>
                <p><? echo __('text.text_114') ?></p>
            </a>
        </div>
       
        <div class="link">
            <a class="{{ (request()->is('user/orders/in')) ? 'active' : '' }} count-link" data-count="<?php echo $in_orders ?>" href="<?php echo route('user.orders.in') ?>">
                <div class="icon fill-inherit">
                    <img src="account/images/m2.svg"/>
                    <?php //include 'images/m2.svg'; ?>
                </div>
                <p><? echo __('text.text_115') ?></p>
            </a>
        </div>
        <div class="link">
            <a class="{{ (request()->is('user/orders/out')) ? 'active' : '' }} count-link" data-count="<?php echo $out_orders ?>" href="<?php echo route('user.orders.out') ?>">
                <div class="icon fill-inherit">
                    <img src="account/images/m3.svg"/>
                    <?php //include 'images/m3.svg'; ?>
                </div>
                <p><? echo __('text.text_116') ?></p>
            </a>
        </div>
        <hr>
        <div class="link">
            <a href="<?php echo route('channels.favorite') ?>">
                <div class="icon fill-inherit">
                    <img src="account/images/m4.svg"/>
                    <?php //include 'images/m4.svg'; ?>
                </div>
                <p><? echo __('text.text_117') ?></p>
            </a>
        </div>
        <div class="link">
            <a href="<?php echo route('channels.blacklist') ?>">
                <div class="icon fill-inherit">
                    <img src="account/images/m5.svg"/>
                    <?php //include 'images/m5.svg'; ?>
                </div>
                <p><? echo __('text.text_118') ?></p>
            </a>
        </div>
        <hr>
        <div class="link">
            <a href="<?php echo route('page','referalna-programa') ?>">
                <div class="icon fill-inherit">
                    <img src="account/images/m6.svg"/>
                    <?php //include 'images/m6.svg'; ?>
                </div>
                <p><? echo __('text.text_119') ?></p>
            </a>
        </div>
        <div class="link">
            <a href="<?php echo route('page','prosuvaisia-u-nas') ?>">
                <div class="icon fill-inherit">
                    <img src="account/images/m7.svg"/>
                    <?php //include 'images/m7.svg'; ?>
                </div>
                <p><? echo __('text.text_120') ?></p>
            </a>
        </div>
        <div class="link">
            <a href="<?php echo route('page','tex-pidtrimka') ?>">
                <div class="icon fill-inheritn">
                    <img src="account/images/m8.svg"/>
                    <?php //include 'images/m8.svg'; ?>
                </div>
                <p><? echo __('text.text_121') ?></p>
            </a>
        </div>
        <div class="link">
            <a href="<?php echo route('page','pro-nas') ?>">
                <div class="icon fill-inherit">
                    <img src="account/images/m9.svg"/>
                    <?php //include 'images/m9.svg'; ?>
                </div>
                <p><? echo __('text.text_122') ?></p>
            </a>
        </div>
        
        <?php } ?>
        
    </div>
</div>