<template>
  <div class="main-div">
    <Navbar></Navbar>

    <!-- Main content block -->
    <div v-if="!hideMainContent" class="main container mb-4">
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

    <!-- Render nested content based on child route -->
    <router-view name="content"></router-view>
  </div>

  <!-- Footer section -->
  <div class="footer_details footer">
    <div class="container-fluid">
      <Footer></Footer>
    </div>
  </div>
</template>

<script>
import { computed,onMounted } from "vue";
// Import your components
import Navbar from '../frontend/Navbar.vue';
import Footer from '../frontend/Footer.vue';
import Headline from '../frontend/Headline.vue';
import ImageProfile from '../frontend/ImageProfile.vue';
import TeacherStaffqty from '../frontend/TeacherStaffqty.vue';
import InstituteView from '../frontend/InstituteView.vue';
import PropiterTeacher from '../frontend/PropiterTeacher.vue';
import WebboardNews from '../frontend/WebboardNews.vue';
import WinnerGallery from '../frontend/WinnerGallery.vue';
import Magazine from '../frontend/Magazine.vue';
import Campus from '../frontend/Campus.vue';
import { useRoute, useRouter } from 'vue-router';
export default {
  name: "HomeFront",
  components: {
    Navbar,
    Footer,
    Headline,
    ImageProfile,
    TeacherStaffqty,
    InstituteView,
    PropiterTeacher,
    WebboardNews,
    WinnerGallery,
    Magazine,
    Campus
  },
  setup() {
    const route = useRoute();
    const router = useRouter();
    const hideMainContent = computed(() => route.meta.hideMainContent);
    onMounted(async () => {
      if (await User.loggedIn()) {
        router.push({ name: "BackHome" });
      }
    });
    return {
      hideMainContent
    };
  }
}
</script>

<style scoped>
/* Add any custom styles here */
</style>