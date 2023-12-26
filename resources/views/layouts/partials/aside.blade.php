  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard')}}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : ''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    الرئيسية
                </p>
                </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.users')}}" class="nav-link {{ request()->is('admin/users') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  الأدمن/ورؤساء الورش
              </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.allPartners')}}" class="nav-link {{ request()->is('admin/allPartners') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  شركاء المقلع
              </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.crushers')}}" class="nav-link {{ request()->is('admin/crushers') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  زبائن المقلع
              </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.expense')}}" class="nav-link {{ request()->is('admin/crushers/expense') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  مصاريف المقلع
              </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.crushers.operations')}}" class="nav-link {{ request()->is('admin/crushers/operations') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  صندوق المقلع
              </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.lab.purchases')}}" class="nav-link {{ request()->is('admin/lab/purchases') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  عمليات شراء المعمل
              </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.lab.salesOperations')}}" class="nav-link {{ request()->is('admin/lab/salesOperations') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  عمليات مبيع المعمل
              </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                 المعمل
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="{{ route('admin.lab.subjects')}}" class="nav-link  {{ request()->is('admin/lab/subjects') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المواد الاولية</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.lab.category')}}" class="nav-link  {{ request()->is('admin/lab/category') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>منتجات المعمل</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.lab.partners')}}" class="nav-link  {{ request()->is('admin/lab/partners') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>موردي المواد</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.lab.clients')}}" class="nav-link  {{ request()->is('admin/lab/clients') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>زبائن المعمل</p>
                  </a>
                </li>
              </ul>
            </li>            
            
            {{-- <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                 التقارير
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="{{ route('admin.crushReport')}}" class="nav-link {{ request()->is('admin/crushReport') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>تقارير المقلع</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      تقارير المعمل
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="{{ route('admin.labInsideReport')}}" class="nav-link {{ request()->is('admin/labReport') ? 'active' : ''}}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>تقارير المعمل/الداخل</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('admin.labOutsideReport')}}" class="nav-link {{ request()->is('admin/labReport') ? 'active' : ''}}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>تقارير المعمل/الخارج</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('admin.labWorkerReport')}}" class="nav-link {{ request()->is('admin/labReport') ? 'active' : ''}}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>تقارير المعمل/العمال</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li> --}}
            <li class="nav-item">
              <a href="{{ route('admin.store')}}" class="nav-link {{ request()->is('admin/store') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  المستودع
              </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  العمال
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="{{ route('admin.worker')}}" class="nav-link  {{ request()->is('admin/worker') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>العمال</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.activities')}}" class="nav-link  {{ request()->is('admin/activities') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>انشطة العمال</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.setting')}}" class="nav-link {{ request()->is('admin/setting') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  الاعدادات
              </p>
              </a>
            </li>
            {{-- <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Level 1
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                  </a>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Level 2
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                  </a>
                </li>
              </ul>
            </li> --}}
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  تسجيل خروج
                </p>
              </a>
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>