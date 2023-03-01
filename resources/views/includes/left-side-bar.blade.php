<div class="leftside-menu leftside-menu-detached">

    <div class="leftbar-user">
        <a href="javascript: void(0);">
            @if(\Illuminate\Support\Facades\Auth::user()->image == null)
                {{--      if there is no pic then default will display--}}

                <img alt="user-image" height="42"
                     class="rounded-circle shadow-sm"
                     src="{{ asset('backend/images/black_member_profile_picture.jpg') }}">
            @else
                <img alt="user-image" height="42"
                     class="rounded-circle"
                     src="{{ asset('/backend/images/user/profile/'.Illuminate\Support\Facades\Auth::user()->image) }}">
            @endif
            <span class="leftbar-user-name">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">

        <li class="side-nav-title side-nav-item">Navigation</li>

        <li class="side-nav-item">
            <a href="{{route('dashboard')}}" class="side-nav-link">
                <i class="uil-home-alt"></i>
                <span> Dashboard </span>
            </a>
        </li>


        <li class="side-nav-title side-nav-item">Gym Member</li>
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'trainer')
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#personalTraining" aria-expanded="false"
                   aria-controls="personalTraining"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>Personal Training </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="personalTraining">
                    <ul class="side-nav-second-level">
                        <li>

                            <a href="{{route('personalTraining')}}">Personal Training</a>

                        </li>

                    </ul>
                </div>
            </li>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'owner' || \Illuminate\Support\Facades\Auth::user()->type == 'superAdmin')
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gymMembers" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> Members </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gymMembers">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addMember')}}">Create Member</a>
                            <a href="{{route('memberList')}}">Members List</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gymMemberFee" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-atm-card"></i>
                    <span>Member  Fee  </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gymMemberFee">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addFee')}}">Collect Member Fee</a>

                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Gym Expenses</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gymExpense" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class=" uil-calculator-alt"></i>
                    <span>  Expenses </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gymExpense">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addExpense')}}">Create Expense</a>
                            <a href="{{route('expenseList')}}">Expenses List</a>
                        </li>

                    </ul>
                </div>
            </li>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->type != 'trainer' && \Illuminate\Support\Facades\Auth::user()->type != 'developer')

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gymMemberAttendance" aria-expanded="false"
                   aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>Member  Attendance  </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gymMemberAttendance">
                    <ul class="side-nav-second-level">
                        <li>

                            <a href="{{route('addAttendance')}}">Mark Attendance</a>
                            <a href="{{route('addAttendanceById')}}">Mark Attendance By Id</a>

                        </li>

                    </ul>
                </div>
            </li>
            {{--   Pages  Access  Only to Owner --}}
            {{--        @if(\Illuminate\Support\Facades\Auth::user() == 'owner')--}}

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#employeeAttendance" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>  Employee Attendance </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="employeeAttendance">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addEmployeeAttendance')}}">Mark Employee Attendance</a>
                        </li>

                    </ul>
                </div>
            </li>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'owner')
            <li class="side-nav-title side-nav-item">Gym Inventory</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gymInventory" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>  Inventory </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gymInventory">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addInventory')}}">Create Inventory</a>
                            <a href="{{route('inventoryList')}}">Inventory List</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Gym Package</li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gymPackage" aria-expanded="false" aria-controls="gymPackage"
                   class="side-nav-link">
                    <i class="uil-money-bill-stack"></i>
                    <span> Fee  Package </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gymPackage">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addPackage')}}">Create Package</a>
                        </li>
                        <li><a href="{{route('packagesList')}}">Packages List</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Reports</li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="gymPackage"
                   class="side-nav-link">
                    <i class="uil-receipt"></i>
                    <span>  Reports </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="reports">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('reports')}}">Reports List</a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Employee Package</li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#employeePackage" aria-expanded="false" aria-controls="gymPackage"
                   class="side-nav-link">
                    <i class="uil-money-bill-stack"></i>
                    <span> Salary Package </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="employeePackage">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addEmployeePackage')}}">Create Employee Package</a>
                        </li>
                        <li>
                            <a href="{{route('employeePackagesList')}}"> Employee Packages List</a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Gym Employee</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gymEmployee" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>  Employees </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gymEmployee">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addEmployee')}}">Create Employee</a>
                            <a href="{{route('employeeList')}}">Employee List</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#employeeSalary" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>  Employee Salary </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="employeeSalary">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addSalary')}}">Pay Employee Salary</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#employeeAttendance" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>  Employee Attendance </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="employeeAttendance">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addEmployeeAttendance')}}">Mark Employee Attendance</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Member Things</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#memberThings" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>  Manage Things </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="memberThings">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addMemberThing')}}">Add Thing</a>
                            <a href="{{route('thingsList')}}">Things List</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Manage Task</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#task" aria-expanded="false" aria-controls="gymMembers"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>  Manage Task </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="task">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addTask')}}">Add Task</a>
                            <a href="{{route('taskList')}}">Task List</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Manage User</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>  Manage User </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="user">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addUser')}}">Add User</a>
                            <a href="{{route('userList')}}">Users List</a>
                        </li>

                    </ul>
                </div>
            </li>


        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'developer')

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gymCreate" aria-expanded="false" aria-controls="gymCreate"
                   class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span>  Gyms </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gymCreate">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('addGym')}}">Create Gym</a>
                            <a href="{{route('gymList')}}">Gym List</a>
                        </li>

                    </ul>
                </div>
            </li>



        @endif
        {{--        @endif--}}

        {{--   Pages  Access  Only to Owner --}}


    </ul>

    <!-- End Sidebar -->

    <div class="clearfix"></div>
    <!-- Sidebar -left -->

</div>
