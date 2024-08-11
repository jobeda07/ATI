 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('employee.index')}}">
          <i class="bi bi-grid"></i>
          <span>Employee</span>
        </a>
      </li>
    
       <li class="nav-item">
        <a class="nav-link " href="{{route('show.department.employees')}}">
          <i class="bi bi-grid"></i>
          <span>Department Wise Employees</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link " href="{{route('salaries.create')}}">
          <i class="bi bi-grid"></i>
          <span>Salary Sheet</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('message.index')}}">
          <i class="bi bi-grid"></i>
          <span>Message</span>
        </a>
      </li>

    </ul>

  </aside>


  <script src="{{ mix('js/app.js') }}"></script>
