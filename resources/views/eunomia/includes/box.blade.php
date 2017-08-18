<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $users->count() }}</h3>

                <p>Usuarios</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-stalker"></i>
            </div>
            <a href="/eunomia/usuarios" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $noticias->count() }}</h3>

                <p>Noticias</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-locate"></i>
            </div>
            <a href="/eunomia/contents" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>{{ $entrevistas->count() }}</h3>

                <p>Entrevistas
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-folder"></i>
            </div>
            <a href="/eunomia/contents" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $ponentes->count() }}</h3>

                <p>Ponentes</p>
            </div>
            <div class="icon">
                <i class="ion ion-clipboard"></i>
            </div>
            <a href="/eunomia/ponentes" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>


    <!-- ./col -->

</div>
<!-- /.row -->
