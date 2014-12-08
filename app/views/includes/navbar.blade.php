    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>                
                <a class="navbar-brand" href="#" title="e-Yantra">{{ HTML::image('img/logo1.png') }}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" style="font-size: 20px; margin-top: 20px;">                    
                    <li class="page-scroll"><li><a href="{{ URL::to('homepage') }}"></a></li>
                    <li class="page-scroll"><li><a href="{{ URL::to('homepage') }}"><?php if(Session::has('username')){
                        echo Session::get('username'); } ?></a></li>
                    <li class="page-scroll"><li><a href="{{ URL::to('/auth/logout') }}">Logout</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>