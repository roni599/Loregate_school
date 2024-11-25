<template>
    <div class="header mb-2">
        <nav class="navbar navbar-expand-lg navbar-light nav_color px-2">
            <div class="container-fluid d-flex justify-content-between align-items-center w-100">
                <div class="loragate d-flex align-items-center text-white">
                    <img v-if="academy_details.academy_logo"
                        :src="`/backend/images/academy/${academy_details.academy_logo}`" width="50" height="50"
                        class="rounded-circle me-2">
                    <div class="no-line-height">
                        <h6 class="m-0 d-inline education_font_size">{{ academy_details.academy_name }}</h6><br>
                        <span class="m-0 education_font">{{ academy_details.academy_address }}</span><br>
                        <span class="education_font">{{ academy_details.academy_mobile_number }}</span>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link class="nav-link active text-white fs-5" aria-current="page"
                                to="/">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link text-white fs-5" to="/home-noticeboard">Notice</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5" href="#">Admission</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5" href="#">Result</a>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link text-white fs-5" to="/login">Login</router-link>
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
</style>