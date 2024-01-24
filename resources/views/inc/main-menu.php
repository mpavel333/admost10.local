
<div class="panel-banner white-block min-banner for-panel-menu d-none d-xl-block">
    <div class="panel-menu panel-menu-move">
        
        <?php if(Auth::user()){ ?>
        <div class="link">
            <a class="{{ (request()->is('/user') OR request()->is('/user/channels')) ? 'active' : '' }}" href="<?php echo route('user.channels') ?>">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m1.svg"/>
                    <?php //include 'images/m1.svg'; ?>
                </div>
                <p><? echo __('text.text_113') ?></p>
            </a>
        </div>

        <div class="link">
            <a class="{{ (request()->is('/user/publications')) ? 'active' : '' }}" href="<?php echo route('user.publications') ?>">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m1.svg"/>
                    <?php //include 'images/m1.svg'; ?>
                </div>
                <p><? echo __('text.text_114') ?></p>
            </a>
        </div>
       
        <div class="link">
            <a class="{{ (request()->is('user/orders/in')) ? 'active' : '' }} count-link" data-count="<?php echo $in_orders ?>" href="<?php echo route('user.orders.in') ?>">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m2.svg"/>
                    <?php //include 'images/m2.svg'; ?>
                </div>
                <p><? echo __('text.text_115') ?></p>
            </a>
        </div>
        <div class="link">
            <a class="{{ (request()->is('user/orders/out')) ? 'active' : '' }} count-link" data-count="<?php echo $out_orders ?>" href="<?php echo route('user.orders.out') ?>">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m3.svg"/>
                    <?php //include 'images/m3.svg'; ?>
                </div>
                <p><? echo __('text.text_116') ?></p>
            </a>
        </div>
        <hr>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m4.svg"/>
                    <?php //include 'images/m4.svg'; ?>
                </div>
                <p><? echo __('text.text_117') ?></p>
            </a>
        </div>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m5.svg"/>
                    <?php //include 'images/m5.svg'; ?>
                </div>
                <p><? echo __('text.text_118') ?></p>
            </a>
        </div>
        <hr>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m6.svg"/>
                    <?php //include 'images/m6.svg'; ?>
                </div>
                <p><? echo __('text.text_119') ?></p>
            </a>
        </div>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m7.svg"/>
                    <?php //include 'images/m7.svg'; ?>
                </div>
                <p><? echo __('text.text_120') ?></p>
            </a>
        </div>
        <div class="link">
            <a href="">
                <div class="icon fill-inheritn">
                    <img src="lc-styles/images/m8.svg"/>
                    <?php //include 'images/m8.svg'; ?>
                </div>
                <p><? echo __('text.text_121') ?></p>
            </a>
        </div>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m9.svg"/>
                    <?php //include 'images/m9.svg'; ?>
                </div>
                <p><? echo __('text.text_122') ?></p>
            </a>
        </div>
        
        <?php } ?>
        
    </div>
</div>