<template>
    <div class="header mb-2">
        <nav class="navbar navbar-expand-lg navbar-light nav_color">
            <div class="container-fluid d-flex justify-content-between align-items-center w-100">
                <div class="loragate d-flex align-items-center text-white">
                    <img v-if="academy_details.academy_logo"
                        :src="`/backend/images/academy/${academy_details.academy_logo}`" width="45px" height="45px"
                        class="rounded-circle me-2">
                    <div class="no-line-height">
                        <p class="m-0 d-inline education_font_size">
                            {{ academy_details.academy_name || "Loregate School and College" }}
                        </p><br>
                        <span class="m-0 education_font">{{ academy_details.academy_address }}</span><br>
                        <span class="education_font">{{ academy_details.academy_mobile_number }}</span>
                    </div>
                </div>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link class="nav-link nab_item active text-white" aria-current="page"
                                to="/">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link nab_item text-white"
                                to="/home-noticeboard">Notice</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white nab_item" href="#">Admission</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white nab_item" href="#">Result</a>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link text-white nab_item" to="/login">Login</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "Navbar-vue",
    setup() {
        const academy_details = ref({})
        const fetchData = async () => {
            try {
                const response = await axios.get(`/api/academy/header`);
                if (response.data) {
                    academy_details.value = response.data.data;
                }
            } catch (error) {
                console.log('something wrong')
            }
        }
        onMounted(() => {
            fetchData()
        })
        return {
            fetchData,
            academy_details
        }
    }
}
</script>
<style scoped>
.education_font {
    font-size: 14px;
}

.education_font_size {
    font-size: 18px;
}

.navbar-toggler {
    border: none;
    outline: none;
    box-shadow: none;
}

.navbar-toggler:focus {
    outline: none;
    box-shadow: none;
}

.nab_item {
    font-size: 16px;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-size: contain;
}
</style>