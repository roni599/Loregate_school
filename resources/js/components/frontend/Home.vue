<template>
    <div class="container mb-4">
        <Headline></Headline>
        <ImageProfile></ImageProfile>
        <TeacherStaffqty></TeacherStaffqty>
        <InstituteView></InstituteView>
        <PropiterTeacher></PropiterTeacher>
        <WebboardNews></WebboardNews>
        <WinnerGallery></WinnerGallery>
        <Magazine></Magazine>
        <Campus></Campus>
    </div>
</template>

<script>
import Headline from '../frontend/Headline.vue';
import ImageProfile from '../frontend/ImageProfile.vue';
import TeacherStaffqty from '../frontend/TeacherStaffqty.vue';
import InstituteView from '../frontend/InstituteView.vue';
import PropiterTeacher from '../frontend/PropiterTeacher.vue';
import WebboardNews from '../frontend/WebboardNews.vue';
import WinnerGallery from '../frontend/WinnerGallery.vue';
import Magazine from '../frontend/Magazine.vue';
import Campus from '../frontend/Campus.vue';

export default {
    name: "Home-vue",
    components: {
        Headline,
        ImageProfile,
        TeacherStaffqty,
        InstituteView,
        PropiterTeacher,
        WebboardNews,
        WinnerGallery,
        Magazine,
        Campus,
    },
    setup() {
        return {
         
        }
    }
}
</script>
<style scoped></style>