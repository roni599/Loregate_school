<template>
    <div class="web_link_bord_news container d-flex flex-column flex-md-row justify-content-around mb-4 gap-3">
        <div class="col-12 col-md-6 d-flex flex-column align-items-center">
            <div class="link_text_www_image d-flex gap-3 align-items-center justify-content-center mb-3">
                <div class="www_image">
                    <img src="../../../../public/frontend/images/www.png" width="50px" alt="Website Link">
                </div>
                <div class="link_text">
                    <p class="text-danger fw-bold fs-5 mb-0">Website Link</p>
                </div>
            </div>
            <div class="website_link_table w-100" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <table class="table text-center table-striped table-hover table-bordered">
                    <tbody>
                        <tr v-for="item in webLinks" :key="item.id">
                            <td class="padding">
                                <a :href="item.link" class="text-decoration-none text-dark">{{ item.title }}</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-md-6 d-flex flex-column align-items-center">
            <div class="college_log_notice_bord d-flex gap-3 align-items-center justify-content-center">
                <div class="college_logo">
                    <img src="../../../../public/frontend/images/Dhaka_College_Seal.svg.png" width="50px"
                        alt="Board News">
                </div>
                <div class="notice_text">
                    <p class="text-info fw-bold fs-5">Board News</p>
                </div>
            </div>
            <div class="education_all_news w-100" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <div v-for="boardnews in displayData" :key="boardnews.id" class="card mb-2 gap-2 education_light">
                    <router-link :to="'/home-boardnews/' + boardnews.id" class="text-decoration-none">
                        <div class="card-body text-center bg-info">
                            <p class="fw-bold text-center text-white fs-6 mb-1">{{ boardnews.heading }}</p>
                            <p class="fs-6 text-white">
                                {{ boardnews.description }}
                            </p>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>


    </div>

</template>


<script>
export default {
    name: "WebboardNews",
    props: {
        webLinks: {
            type: Array,
            required: true
        },
        boardNewss: {
            type: Array,
            required: true
        },
        displayData: {
            type: Object,
            required: true
        }
    },
    setup() {
        return {
        }
    }
}
</script>

<style scoped>
.padding {
    padding: 18px;
}

.education_all_news {
    margin-top: 10px;
}

.router-link-active,
.router-link-exact-active,
.router-link {
    text-decoration: none !important;
}
</style>