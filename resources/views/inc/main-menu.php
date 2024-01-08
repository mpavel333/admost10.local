
<div class="panel-banner white-block min-banner for-panel-menu d-none d-xl-block">
    <div class="panel-menu panel-menu-move">
        
        <?php if(Auth::user()){ ?>
        <div class="link">
            <a class="{{ (request()->is('/user') OR request()->is('/user/channels')) ? 'active' : '' }}" href="<?php echo route('user.channels') ?>">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m1.svg"/>
                    <?php //include 'images/m1.svg'; ?>
                </div>
                <p>Мої канали</p>
            </a>
        </div>

        <div class="link">
            <a class="{{ (request()->is('/user/publications')) ? 'active' : '' }}" href="<?php echo route('user.publications') ?>">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m1.svg"/>
                    <?php //include 'images/m1.svg'; ?>
                </div>
                <p>Мої публикации</p>
            </a>
        </div>
       
        <div class="link">
            <a class="{{ (request()->is('user/orders/in')) ? 'active' : '' }} count-link" data-count="<?php echo $in_orders ?>" href="<?php echo route('user.orders.in') ?>">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m2.svg"/>
                    <?php //include 'images/m2.svg'; ?>
                </div>
                <p>Вхідні заявки</p>
            </a>
        </div>
        <div class="link">
            <a class="{{ (request()->is('user/orders/out')) ? 'active' : '' }} count-link" data-count="<?php echo $out_orders ?>" href="<?php echo route('user.orders.out') ?>">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m3.svg"/>
                    <?php //include 'images/m3.svg'; ?>
                </div>
                <p>Вихідні заявки</p>
            </a>
        </div>
        <hr>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m4.svg"/>
                    <?php //include 'images/m4.svg'; ?>
                </div>
                <p>Обрані канали</p>
            </a>
        </div>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m5.svg"/>
                    <?php //include 'images/m5.svg'; ?>
                </div>
                <p>Чорний список</p>
            </a>
        </div>
        <hr>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m6.svg"/>
                    <?php //include 'images/m6.svg'; ?>
                </div>
                <p>Реферальна програма</p>
            </a>
        </div>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m7.svg"/>
                    <?php //include 'images/m7.svg'; ?>
                </div>
                <p>Просувайся у нас</p>
            </a>
        </div>
        <div class="link">
            <a href="">
                <div class="icon fill-inheritn">
                    <img src="lc-styles/images/m8.svg"/>
                    <?php //include 'images/m8.svg'; ?>
                </div>
                <p>Тех. підтримка</p>
            </a>
        </div>
        <div class="link">
            <a href="">
                <div class="icon fill-inherit">
                    <img src="lc-styles/images/m9.svg"/>
                    <?php //include 'images/m9.svg'; ?>
                </div>
                <p>Про нас</p>
            </a>
        </div>
        
        <?php } ?>
        
    </div>
</div>