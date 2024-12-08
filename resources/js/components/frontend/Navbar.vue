<template>
    <div class="header mb-2">
        <nav class="navbar navbar-expand-lg navbar-light nav_color">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Left Section: Logo and Academy Details -->
                <div class="loragate d-flex align-items-center text-white w-75">
                    <img v-if="academy_details.academy_logo"
                        :src="`/backend/images/academy/${academy_details.academy_logo}`" width="45" height="45"
                        class="rounded-circle me-2" alt="Academy Logo">

                    <div class="no-line-height w-100">
                        <template v-if="isMobile && isLongName">
                            <div class="marquee">
                                <span>{{ academy_details.academy_name || "Loregate School and College" }}</span>
                            </div>
                            <!-- <marquee class="m-0 education_font_size">
                                {{ academy_details.academy_name || "Loregate School and College" }}
                            </marquee> -->
                        </template>
                        <template v-else>
                            <p class="m-0 education_font_size">
                                {{ academy_details.academy_name || "Loregate School and College" }}
                            </p>
                        </template>
                        <span class="d-block education_font">
                            <span
                                v-html="formatAddress(academy_details.academy_address || 'Address not available')"></span>
                        </span>
                        <span class="d-block education_font">
                            {{ academy_details.academy_mobile_number || "Phone not available" }}
                        </span>
                    </div>
                </div>
                <button class="navbar-toggler w-25" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Right Section: Navbar Toggle Button and Menu Items -->
                <div class="d-flex align-items-center navbar-right">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <router-link class="nav-link nab_item text-white" to="/">Home</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link nab_item text-white"
                                    to="/home-noticeboard">Notice</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link nab_item text-white" to="/admissionlogin">Admission</router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nab_item text-white" href="#">Result</a>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link nab_item text-white" to="/login">Login</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>



<script>
import axios from 'axios';
import { onMounted, ref, computed } from 'vue';
import router from '../../routes/router';

export default {
    name: "NavbarVue",
    setup() {
        const academy_details = ref({});
        const isMobile = ref(false);

        // Check if the academy name is long
        const isLongName = computed(() =>
            (academy_details.value.academy_name || "Loregate School and College").length > 26
        );

        const formatAddress = (address) => {
            let formattedAddress = '';
            let i = 0;
            while (i < address.length) {
                formattedAddress += address.substring(i, i + 50) + '<br>';
                i += 50;
            }
            return formattedAddress;
        };

        const fetchData = async () => {
            try {
                const response = await axios.get(`/api/academy/header`);
                if (response.data?.data) {
                    academy_details.value = response.data.data;

                    // Set document title and favicon
                    document.title = academy_details.value.academy_name || "Loregate School and College";
                    if (academy_details.value.academy_logo) {
                        const faviconElement = document.getElementById('dynamic-favicon');
                        if (faviconElement) {
                            faviconElement.href = `/backend/images/academy/${academy_details.value.academy_logo}`;
                        }
                    }
                }
            } catch (error) {
                console.error("Error fetching academy details:", error.message);
            }
        };

        const checkScreenSize = () => {
            isMobile.value = window.innerWidth <= 768; // Mobile breakpoint
        };

        onMounted(() => {
            fetchData();
            checkScreenSize();
            window.addEventListener("resize", checkScreenSize);
        });

        return {
            academy_details,
            isMobile,
            isLongName,
            formatAddress
        };
    },
};
</script>
<style scoped>
.education_font {
    font-size: 14px;
}

.education_font_size {
    font-size: 18px;
    font-weight: bold;
}

.navbar-toggler {
    border: none;
    outline: none;
    box-shadow: none;
}

.nab_item {
    font-size: 16px;
    transition: color 0.3s ease;
}

.nab_item:hover {
    color: #ffcc00;
    /* Add hover effect */
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-size: contain;
}
.marquee {
    display: block;
    white-space: nowrap; /* Prevent text from wrapping */
    overflow: hidden; /* Hide text outside the container */
    width: 100%; /* Ensure it spans the full width of the parent container */
    box-sizing: border-box;
    position: relative;
}

.marquee span {
    display: inline-block;
    padding-left: 100%; /* Start off-screen */
    animation: scroll-left 10s linear infinite;
}

@keyframes scroll-left {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(-100%);
    }
}

</style>
