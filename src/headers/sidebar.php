<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed"
               href="<?= ROOT_URL ?>src/filters/views/FilterView.php">
                <i class="bi bi-grid"></i>
                <span>Surgeries</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" id="patient-nav-links" data-bs-target="#components-nav"
               data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Patients</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= ROOT_URL ?>src/patients/views/PatientRegistrationView.php" id="patient-reg">
                        <i class="bi bi-circle"></i><span>Add New Patient</span>
                    </a>
                </li>
                <li>
                    <a href="<?= ROOT_URL ?>src/patients/views/PatientDataListView.php" id="patient-list">
                        <i class="bi bi-circle"></i><span>Patient List</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" id="hospital-nav-links" data-bs-target="#components-nav"
               data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Hospitals</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= ROOT_URL ?>src/hospitals/views/HospitalAddView.php" id="hospital-reg">
                        <i class="bi bi-circle"></i><span>Add New Hospital</span>
                    </a>
                </li>
                <li>
                    <a href="<?= ROOT_URL ?>src/hospitals/views/HospitalListView.php" id="hospital-list">
                        <i class="bi bi-circle"></i><span>Hospital List</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

</aside><!-- End Sidebar-->