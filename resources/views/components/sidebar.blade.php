<div class="sidebar" data-color="purple" data-background-color="white"
    data-image="{{ asset('assets/themes/material-dashboard/img/sidebar-1.jpg') }}">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
        -->
    <div class="logo"><a href="" class="simple-text logo-normal">
            SI Absensi
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ __active('DashboardController') }}">
                <a class="nav-link" href="./dashboard.html">
                    <i class="material-icons">dashboard</i>
                    <p>Dasbor</p>
                </a>
            </li>
            <li class="nav-item {{ __active('CourseController') }}">
                <a class="nav-link" href="{{ route('courses.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>Mata Kuliah</p>
                </a>
            </li>
            <li class="nav-item {{ __active('AttendanceController') }}">
                <a class="nav-link" href="{{ route('attendances.index') }}">
                    <i class="material-icons">bookmarks</i>
                    <p>Absensi</p>
                </a>
            </li>
            <li class="nav-item {{ __active('StudentController') }}">
                <a class="nav-link" href="{{ route('students.index') }}">
                    <i class="material-icons">supervisor_account</i>
                    <p>Mahasiswa</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="./tables.html">
                    <i class="material-icons">pie_chart</i>
                    <p>Laporan</p>
                </a>
            </li>
        </ul>
    </div>
</div>
