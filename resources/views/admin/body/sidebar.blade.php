<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-user-star-line"></i>
                        <span>Participantes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('participantes.index') }}">Lista</a></li>
                        <li><a href="{{ route('participantes.create') }}">Crear</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-group-line"></i>
                        <span>Vendedores</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('vendedores.index') }}">Lista</a></li>
                        <li><a href="{{ route('vendedores.create') }}">Crear</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-ticket-2-line"></i>
                        <span>Tickets</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('tickets.index') }}">Lista</a></li>
                        <li><a href="{{ route('tickets.multiplecreate') }}">Crear</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-funds-line"></i>
                        <span>Reportes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('reporte.tickets') }}">Tickets</a></li>
                        <li><a href="{{ route('reporte.participantes') }}">Participantes</a></li>
                        <li><a href="{{ route('reporte.vendedores') }}">Vendedores</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-3-line"></i>
                        <span>Opciones</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('opciones.index') }}">Generales</a></li>
                        <li><a href="javascript:void(0);" data-href="{{ route('ticket.imagenes') }}" class="imagenes-confirm">Recrear imagenes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-lock-2-line"></i>
                        <span>Roles y Permisos</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('permisos') }}">Permisos</a></li>
                        <li><a href="{{ route('roles') }}">Roles</a></li>
                        <li><a href="{{ route('add.roles.permiso') }}">Roles en permisos</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
