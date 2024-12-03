<template>
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow border-0 rounded-lg">
                <div class="text-center mt-4">
                  <!-- <img src="../../../../public/frontend/images/loregate.png" width="60px" height="60px" alt="images"
                    class="img-fluid mb-2"> -->
                  <img v-if="academy_details.academy_logo" :src="`/backend/images/academy/${academy_details.academy_logo}`" alt="Academy Logo"
                    width="60" height="60" class="img-fluid mb-2 rounded-circle">

                  <h4 class="f-w-500 mb-2">Login with your email</h4>
                </div>
                <div class="card-body">
                  <form @submit.prevent="login">
                    <!-- Email Input -->
                    <div class="form-floating mb-3">
                      <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com"
                        v-model="form.email" />
                      <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                      <label for="inputEmail">Email address</label>
                    </div>

                    <!-- Password Input with Eye Icon -->
                    <div class="form-floating mb-3 position-relative">
                      <input class="form-control" :type="showPassword ? 'text' : 'password'" id="inputPassword"
                        placeholder="Password" v-model="form.password" />
                      <label for="inputPassword">Password</label>
                      <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>

                      <!-- Eye Icon -->
                      <span class="position-absolute end-0 top-50 translate-middle-y me-3"
                        @click="togglePasswordVisibility" style="cursor: pointer;">
                        <i :class="showPassword ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
                      </span>
                    </div>

                    <div class="form-check mb-3">
                      <input class="form-check-input" id="inputRememberPassword" type="checkbox" />
                      <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                      <button class="btn btn-info w-100 mb-2" :disabled="loading">
                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                          aria-hidden="true"></span>
                        <span v-if="!loading">Login</span>
                        <span v-if="loading">Logging in...</span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { onMounted, reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  name: 'Login-From',
  setup() {
    const form = ref({
      email: '',
      password: '',
    });

    const errors = reactive({});
    const loading = ref(false);
    const showPassword = ref(false);
    const router = useRouter();
    const academy_details = ref({})

    const togglePasswordVisibility = () => {
      showPassword.value = !showPassword.value;
    };

    const login = async () => {
      loading.value = true;
      try {
        const res = await axios.post("/api/auth/login", form.value);
        if (res.data) {
          User.responseAfterLogin(res);
          router.push({ name: 'BackHome' });
          Toast.fire({
            icon: "success",
            title: "Signed in successfully"
          });
        }
      } catch (error) {
        if (error.response && error.response.data.errors) {
          errors.value = error.response.data.errors;
          Toast.fire({
            icon: "warning",
            title: "Invalid email or password"
          });
        } else {
          Toast.fire({
            icon: "error",
            title: "An error occurred. Please try again later."
          });
        }
      } finally {
        loading.value = false;
      }
    };

    const fetchData = async () => {
      try {
        const response = await axios.get(`/api/academy/header`);
        if (response.data) {
          academy_details.value = response.data.data;
          const faviconElement = document.getElementById('dynamic-favicon');
          if (academy_details.value.academy_logo && faviconElement) {
            faviconElement.href = `/backend/images/academy/${academy_details.value.academy_logo}`;
          }
        }
      } catch (error) {
        console.log('something wrong')
      }
    }

    onMounted(async () => {
      if (await User.loggedIn()) {
        router.push({ name: "BackHome" });
      }
      fetchData()
    });

    return {
      form,
      errors,
      loading,
      showPassword,
      togglePasswordVisibility,
      login,
      academy_details,
    };
  },
};
</script>

<style scoped>
.position-relative {
  position: relative;
}

.end-0 {
  right: 0;
}

.me-3 {
  margin-right: 1rem;
}

.fas.fa-eye,
.fas.fa-eye-slash {
  color: #6c757d;
}
</style>
