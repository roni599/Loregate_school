<template>
  <div class="main-div">
    <div v-if="loading" class="loading-spinner">
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <Navbar />
    <div v-if="!hideMainContent" class="main container mb-4">
      <Headline :headings="headings" />
      <ImageProfile :slidePicture="slidePicture" :leftPicture="leftPicture" :rightPicture="rightPicture" />
      <TeacherStaffqty :teacherStaffqty="teacherStaffqty" />
      <InstituteView :history="history" :fullHistory="fullHistory" :educationBoard="educationBoard"
        :primePresedent="primePresedent" />
      <PropiterTeacher :academy_details="academy_details" :displayedData="displayedData"
        :displayedData2="displayedData2" :propiterTeacher="propiterTeacher" :teacherGallery="teacherGallery"
        :boardNotices="boardNotices" />
      <WebboardNews :webLinks="webLinks" :boardNewss="boardNewss" :displayData="displayData" />
      <WinnerGallery :WinnerGallery="WinnerGallery" :displayDataWinner="displayDataWinner" />
      <Magazine :magazine="magazine" :displayMagazineData="displayMagazineData" />
      <Campus :campusPicture="[campusPicture]" />
    </div>
    <router-view name="content"></router-view>
  </div>
  <div class="footer_details footer">
      <Footer ></Footer>
  </div>
</template>

<script>
import { computed, onBeforeMount, onMounted, ref } from "vue";
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
import axios from "axios";
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
    const loading = ref(true);
    const route = useRoute();
    const router = useRouter();
    const slidePicture = ref({});
    const leftPicture = ref({});
    const rightPicture = ref({});
    const teacherStaffqty = ref({});
    const history = ref('');
    const fullHistory = ref('');


    const educationBoard = ref({});
    const primePresedent = ref({});
    const propiterTeacher = ref([]);
    const teacherGallery = ref([]);
    const boardNotices = ref([]);
    const academy_details = ref({})
    const webLinks = ref([]);
    const boardNewss = ref([]);
    const WinnerGallery = ref([]);
    const magazine = ref([]);
    const campusPicture = ref([]);
    const headings = ref([]);



    const displayedData = computed(() => propiterTeacher.value.slice(0, 2));
    const displayedData2 = computed(() => teacherGallery.value.slice(0, 2));
    const displayData = computed(() => boardNewss.value.slice(0, 4))
    const displayDataWinner = computed(() => WinnerGallery.value.slice(0, 3));
    const displayMagazineData = computed(() => magazine.value.slice(0, 4))


    const hideMainContent = computed(() => route.meta.hideMainContent);
    onBeforeMount(async () => {
      await axios.get('/api/all/Data')
        .then((response) => {
          headings.value = response.data.data.heading
          slidePicture.value = response.data.data.slidepicture;
          leftPicture.value = response.data.data.leftPicture;
          rightPicture.value = response.data.data.rightPicture;
          teacherStaffqty.value = response.data.data.staffDataId;
          fullHistory.value = response.data.data.academyHistory.history;
          educationBoard.value = response.data.data.educationBoard;
          primePresedent.value = response.data.data.primepresedent;
          propiterTeacher.value = response.data.data.managingCummunity;
          teacherGallery.value = response.data.data.teacherGallery;
          boardNotices.value = response.data.data.boardNotice;
          academy_details.value = response.data.data.academy;
          webLinks.value = response.data.data.websitelink
          boardNewss.value = response.data.data.boardNews
          WinnerGallery.value = response.data.data.winnergallery
          magazine.value = response.data.data.magazine
          campusPicture.value = response.data.data.campusPicture
          const words = fullHistory.value.split(' ');
          if (words.length > 200) {
            history.value = `${words.slice(0, 200).join(' ')}`;
          } else {
            history.value = words.join(' ');
          }
        })
        .catch((error) => {
          console.log(error)
        })
        .finally(() => {
          loading.value = false;
        })
    })
    onMounted(async () => {
      if (await User.loggedIn()) {
        router.push({ name: "BackHome" });
      }
    });
    return {
      loading,
      hideMainContent,
      slidePicture,
      leftPicture,
      rightPicture,
      teacherStaffqty,
      history,
      fullHistory,
      educationBoard,
      primePresedent,
      propiterTeacher,
      displayedData,
      displayedData2,
      teacherGallery,
      boardNotices,
      academy_details,
      webLinks,
      boardNewss,
      displayData,
      WinnerGallery,
      displayDataWinner,
      displayMagazineData,
      magazine,
      campusPicture,
      headings
    };
  }
}
</script>

<style scoped>
.loading-spinner {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f8f9fa;
}
</style>

<!-- <template>
  <div class="main-div">
    <Navbar />
    <div v-if="loading" class="loading-spinner">
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <div v-else>
      <div v-if="!hideMainContent" class="main container mb-4">
        <Headline :headings="headings" />
        <ImageProfile :slidePicture="slidePicture" :leftPicture="leftPicture" :rightPicture="rightPicture" />
        <TeacherStaffqty :teacherStaffqty="teacherStaffqty" />
        <InstituteView :history="history" :fullHistory="fullHistory" :educationBoard="educationBoard" :primePresedent="primePresedent" />
        <PropiterTeacher :academy_details="academy_details" :displayedData="displayedData" :displayedData2="displayedData2" :propiterTeacher="propiterTeacher" :teacherGallery="teacherGallery" :boardNotices="boardNotices" />
        <WebboardNews :webLinks="webLinks" :boardNewss="boardNewss" :displayData="displayData" />
        <WinnerGallery :WinnerGallery="WinnerGallery" :displayDataWinner="displayDataWinner" />
        <Magazine :magazine="magazine" :displayMagazineData="displayMagazineData" />
        <Campus :campusPicture="[campusPicture]" />
      </div>
      <router-view name="content"></router-view>
      <div class="footer_details footer">
        <div class="container-fluid">
          <Footer></Footer>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { computed, onBeforeMount, ref } from "vue";
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
import { useRoute } from 'vue-router';
import axios from "axios";

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
    const loading = ref(true);
    const route = useRoute();
    const slidePicture = ref({});
    const leftPicture = ref({});
    const rightPicture = ref({});
    const teacherStaffqty = ref({});
    const history = ref('');
    const fullHistory = ref('');
    const educationBoard = ref({});
    const primePresedent = ref({});
    const propiterTeacher = ref([]);
    const teacherGallery = ref([]);
    const boardNotices = ref([]);
    const academy_details = ref({});
    const webLinks = ref([]);
    const boardNewss = ref([]);
    const WinnerGallery = ref([]);
    const magazine = ref([]);
    const campusPicture = ref([]);
    const headings = ref([]);
    const displayedData = computed(() => propiterTeacher.value.slice(0, 2));
    const displayedData2 = computed(() => teacherGallery.value.slice(0, 2));
    const displayData = computed(() => boardNewss.value.slice(0, 4));
    const displayDataWinner = computed(() => WinnerGallery.value.slice(0, 3));
    const displayMagazineData = computed(() => magazine.value.slice(0, 4));

    const hideMainContent = computed(() => route.meta.hideMainContent);
    onBeforeMount(async () => {
      try {
        const response = await axios.get('/api/all/Data');
        const data = response.data.data;

        headings.value = data.heading;
        slidePicture.value = data.slidepicture;
        leftPicture.value = data.leftPicture;
        rightPicture.value = data.rightPicture;
        teacherStaffqty.value = data.staffDataId;
        fullHistory.value = data.academyHistory.history;
        educationBoard.value = data.educationBoard;
        primePresedent.value = data.primepresedent;
        propiterTeacher.value = data.managingCummunity;
        teacherGallery.value = data.teacherGallery;
        boardNotices.value = data.boardNotice;
        academy_details.value = data.academy;
        webLinks.value = data.websitelink;
        boardNewss.value = data.boardNews;
        WinnerGallery.value = data.winnergallery;
        magazine.value = data.magazine;
        campusPicture.value = data.campusPicture;
        const words = fullHistory.value.split(' ');
        history.value = words.length > 200 ? `${words.slice(0, 200).join(' ')}...` : words.join(' ');

        loading.value = false;
      } catch (error) {
        console.error("Error loading data:", error);
      }
    });

    return {
      loading,
      hideMainContent,
      slidePicture,
      leftPicture,
      rightPicture,
      teacherStaffqty,
      history,
      fullHistory,
      educationBoard,
      primePresedent,
      propiterTeacher,
      displayedData,
      displayedData2,
      teacherGallery,
      boardNotices,
      academy_details,
      webLinks,
      boardNewss,
      displayData,
      WinnerGallery,
      displayDataWinner,
      displayMagazineData,
      magazine,
      campusPicture,
      headings
    };
  }
};
</script>
<style scoped>
.loading-spinner {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f8f9fa;
}
</style> -->
