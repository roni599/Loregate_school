<template>
    <div class="main">
        <nav class="sb-topnav navbar navbar-expand navbar-info bg-info" v-show="$route.path === '/' ||
            $route.path === '/register' ||
            $route.path === '/forget'
            ? false
            : true
            ">
            <router-link class="navbar-brand ps-3" to="/admin-dashboard">
                <h5 class="text-white">Dhaka College</h5>
            </router-link>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
                <i class="fas fa-bars text-white fs-4"></i>
            </button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <div class="form-group mb-0 d-flex align-items-center">
                    </div>
                </div>
            </form>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img v-if="usersProfile.image" v-show="!loading" @load="handleImageLoad" :src="`/backend/images/users/${usersProfile.image}`"
                            class="images" alt="">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><router-link class="dropdown-item" to="/edit_profile">Settings</router-link></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <router-link class="dropdown-item" to="/logout">Logout</router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav" v-show="$route.path === '/' ||
                $route.path === '/register' ||
                $route.path === '/forget'
                ? false
                : true
                ">
                <nav class="sb-sidenav accordion sb-sidenav-light shadow" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav sb-sidenav-menu-heading">
                            <div class="sb-sidenav-menu-heading">
                                <p>Navigation</p>
                            </div>
                            <router-link class="nav-link rounded-end mb-1 bg-secondary text-white"
                                to="/admin-dashboard">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-home text-white"></i>
                                </div>
                                Dashboard
                            </router-link>
                            <router-link class="nav-link rounded-end mb-1" to="/user-create">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-users mt-1"></i>
                                </div>
                                User Create
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/header">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-book-open-reader"></i>
                                </div>
                                Header
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/heading_in">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-heading"></i>
                                </div>
                                Headline
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/slide_picture">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-sliders"></i>
                                </div>
                                Sliding Picture
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/left_picture">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-left-long"></i>
                                </div>
                                Left Picture
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/right_picture">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-right-long"></i>
                                </div>
                                Right Picture
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/teacher_student_gellery">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-brands fa-envira"></i>
                                </div>
                                Teacher & Student Gallery
                            </router-link>
                            <router-link class="nav-link rounded-end mb-1" to="/primemenister_president">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-person"></i>
                                </div>
                                Primenister & President
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/education_board">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-school"></i>
                                </div>
                                Education Minister& Board
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/academic_history">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-notes-medical"></i>
                                </div>
                                Academic History
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/managing">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-walkie-talkie"></i>
                                </div>
                                Managing Community
                            </router-link>
                            <router-link class="nav-link rounded-end mb-1" to="/teacher_gallery">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </div>
                                Teacher Galley
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/notice_board">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-flag"></i>
                                </div>
                                Notice Board
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/website_link">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-link"></i>
                                </div>
                                Website Link
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/board_news">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-newspaper"></i>
                                </div>
                                Board News
                            </router-link>
                            <router-link class="nav-link rounded-end mb-1" to="/winner_gallery">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-person-skiing-nordic"></i>
                                </div>
                                Winner Gallery
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/magazine">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-regular fa-face-grin-tongue-wink"></i>
                                </div>
                                Magazine
                            </router-link>

                            <router-link class="nav-link rounded-end mb-1" to="/campus">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-tents"></i>
                                </div>
                                Campus
                            </router-link>
                            <router-link class="nav-link rounded-end mb-1" to="/media_link">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-photo-film"></i>
                                </div>
                                Media Link
                            </router-link>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" :class="{
                'pc-container': true,
                'custom-style':
                    $route.path !== '/' &&
                    $route.path !== '/register' &&
                    $route.path !== '/forget',
            }">
                <main>
                    <div class="container-fluid px-2" :class="{
                        'pc-content': true,
                        'no-padding':
                            $route.path === '/' ||
                            $route.path === '/register' ||
                            $route.path === '/forget',
                    }">
                        <!-- <router-view></router-view> -->
                        <router-view name="content"></router-view>
                    </div>
                </main>
                <footer class="py-3 w-100">
                    <div class="container-fluid" v-show="$route.path === '/' ||
                        $route.path === '/register' ||
                        $route.path === '/forget'
                        ? false
                        : true
                        ">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
import { useRouter } from 'vue-router';
import { onMounted, ref } from 'vue';
export default {
    name: "App",
    setup() {
        const router = useRouter();
        const usersProfile = ref({});
        const loading=ref(true);

        const userdataFetch = async () => {
            const token = localStorage.getItem('token');
            await axios.get("/api/auth/me", {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then((res) => {
                usersProfile.value=res.data;
            })
            .catch((error) => {
                console.log(error);
            });
        }
        const handleImageLoad=()=>{
            loading.value = false;
        };

        onMounted(async () => {
            if (!(await User.loggedIn())) {
                router.push({ name: "Login" });
            }
            else {
                userdataFetch();
            }
        });
        return {
            usersProfile,
            handleImageLoad,
            loading
        };
    },
};
</script>

<style>
.input-group {
    position: relative;
}

.input-group .input-group-text {
    position: absolute;
    left: 10px;
    /* Adjust position */
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
}

.input-group .form-control {
    padding-left: 35px;
    /* Adjust padding to make room for the icon */
}

.pc-container {
    position: relative;
}

.pc-container .pc-content {
    padding-left: 35px;
    /* padding-right: 35px; */
    /* padding-top: 35px; */
}

.custom-style {
    padding-left: 227px;
    top: 56px;
    padding-top: 5px;
    min-height: calc(100vh - 130px);
}

.no-padding {
    padding-left: 0px;
    padding-right: 0px;
    padding-top: 0px;
}

@media (max-width: 1200px) {
    .custom-style {
        margin-left: 200px;
        padding-left: 245px;
        top: 50px;
    }
}

@media (max-width: 992px) {
    .custom-style {
        margin-left: 150px;
        top: 40px;
        min-height: calc(100vh - 100px);
    }

    .no-padding {
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 20px;
    }
}

.images {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 2px solid #708090;
}

@media (max-width: 768px) {
    .custom-style {
        margin-left: 0;
        top: 40px;
        min-height: calc(100vh - 80px);
    }

    .no-padding {
        padding-left: 5px;
        padding-right: 5px;
    }
}

@media (max-width: 576px) {
    .custom-style {
        margin-left: 0;
        top: 40px;
        min-height: calc(100vh - 60px);
    }

    .no-padding {
        padding-left: 0;
        padding-right: 0;
    }
}

@media print {

    #navbar,
    #layoutSidenav_nav,
    #footer {
        display: none;
    }

    #layoutSidenav_content {
        margin: 0;
        padding: 0;
    }

    /* Ensure the content you want to print is visible */
    #print-area {
        display: block;
    }

    .logo-lg {
        display: none;
    }

    footer {
        display: none;
    }
}
</style>
