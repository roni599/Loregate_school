<template></template>

<script>
export default {
    name: "Logout-From",
    mounted() {
        User.logout();
        this.$router.push({ name: "HomeFront" });
        Toast.fire({
            icon: "success",
            title: "Successfully Log Out!"
        });
    },
    data() {
        return {

        }
    }
}
</script>

<style></style>