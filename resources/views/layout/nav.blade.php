<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="/" class="logo">VirtualCareer<em> Expo</em></a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="/" class="active">Home</a></li>
                        <li><a href="jobs">Find Jobs</a></li>
                        <li><a href="about">About Us</a></li>
                        <li><a href="contact">Contact</a></li>

                        @if (session('status')=='true')
                            <li><a href="/logout">Logout</a></li>
                        @else
                            <li><a href="/login">Login</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Register</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="jobSeekerRegister">As Job Seeker</a>
                                    <a class="dropdown-item" href="employerRegister">As Employer</a>
                                </div>
                            </li>
                        @endif
                            
                        
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
