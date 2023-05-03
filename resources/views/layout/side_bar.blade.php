@php
    
    function expandParentOnUrl($parent)
    {
        $childs = "$parent/*";
        return \Request::is($parent) || \Request::is($childs) ? 'show' : '';
    }
    
    function activeRoute($route)
    {
        return Route::currentRouteName() == $route ? 'active show' : '';
    }
@endphp


<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
  
        <ul class="sidebar-nav" id="sidebar-nav">
    
          <li class="nav-item">
            <a class="nav-link collapsed {{ activeRoute('dashboard') }}" href="{{ route('dashboard') }}" >
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
            </a>
          </li><!-- End Dashboard Nav -->

          {{-- USERS START --}}
          <li class="nav-item">
            <a class="nav-link collapsed {{ expandParentOnUrl('user') }}" data-bs-target="#components-users" data-bs-toggle="collapse" href="#" >
              <i class="bi bi-menu-button-wide"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-users" class="nav-content collapse" data-bs-parent="#sidebar-nav">
              <li>
                <a  class="{{ activeRoute('user.index') }}" href="{{ route('user.index') }}">
                  <i class="bi bi-circle"></i><span>Index</span>
                </a>
              </li>

              <li>
                <a  class="{{ activeRoute('user.create') }}" href="{{ route('user.create') }}">
                  <i class="bi bi-circle"></i><span>Create</span>
                </a>
              </li>
            </ul>
          </li>
          {{-- USERS END --}}

          {{-- ROLE START --}}
          <li class="nav-item">
            <a class="nav-link collapsed {{ expandParentOnUrl('role') }}" data-bs-target="#components-roles" data-bs-toggle="collapse" href="#" >
              <i class="bi bi-menu-button-wide"></i><span>Roles</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-roles" class="nav-content collapse" data-bs-parent="#sidebar-nav">
              <li>
                <a  class="{{ activeRoute('role.index') }}" href="{{ route('role.index') }}">
                  <i class="bi bi-circle"></i><span>Index</span>
                </a>
              </li>

              <li>
                <a  class="{{ activeRoute('role.create') }}" href="{{ route('role.create') }}">
                  <i class="bi bi-circle"></i><span>Create</span>
                </a>
              </li>
            </ul>
          </li>
          {{-- ROLE END --}}


        </ul>
    
      </aside><!-- End Sidebar-->



      @push('custom_js')
        <script>
          let nav_links =  $('#sidebar a.nav-link.collapsed.show');
    
          $.each(nav_links,function(index,navlink){
    
            $(navlink).removeClass('collapsed');
            let target = $(this).data('bs-target');
            $(target).addClass('show');
          });
        </script>
      @endpush