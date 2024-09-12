<template>
    
        <div class="giftcard-log-sub-main">
        <div class="giftcard-log-sub-header">
            <a href="javascript:void(0)"
                ><img
                    src="https://ewardsmain.s3.ap-southeast-1.amazonaws.com/ewards/mainsite/logo_new.png"
            /></a>
        </div>
        <div class="row">
            <div class="col-md-5 dispalynone-mob">
                <div class="log-gift-img">
                    <img
                        src="https://i.imgur.com/E4utzib.png"
                    />
                </div>
            </div>
            <div class="offset-md-2 col-md-4 no-padding">
                <form class="log-gift-part" @submit.prevent="login">
                    <img
                        src="https://ewardsdata.s3.ap-south-1.amazonaws.com/gift_card/white_rectangle.png"
                    />
                    <div class="login-part-cont">
                        <h4>PARTNER LOGIN</h4>
                        <div class="login-mobil">
                            <div class="input-group">

                                <!-- <label class="placeholder">Account Type</label> -->
                                 
                                <select class="input" v-model="form.login_type">
                                    <option value="1">
                                        Account Type
                                    </option>
                                    <option value="2">Admin</option>
                                    <option value="3">Sub-account</option>
                                </select>
                                <span class="login_type_custom"></span>
                            </div>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="input"
                                    v-model="form.email"
                                    @blur="required"
                                />
                                <label class="placeholder">Email</label>
                                <span class="login_email_custom"></span>
                            </div>
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="input"
                                    v-model="form.password"
                                />
                                <label class="placeholder">Password</label>
                                <span class="login_password_custom"></span>
                            </div>
                            <div class="log-btn">
                                <button class="btn" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="log-error" v-if="error">{{ error }}</p>
            </div>
        </div>
        </div>
       
</template>
<script>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
export default {
    setup() {
        let form = reactive({
            email: "",
            password: "",
            login_type: "1",
        });
        const router = useRouter();
        isRequired: false;
        let error = ref("");
        const login = async () => {
            await axios
                .post("/api/loginOnboardingDashboard", form)
                .then((res) => {
                    if (!res.data.error) {
                        // Store the token and expiration time in localStorage
                        const accessToken =
                            res.data.message.original.access_token;
                        const expiresIn = res.data.message.original.expires_in; // expiration in seconds
                        const expirationTime =
                            Math.floor(Date.now() / 1000) + expiresIn; // current time + expires_in

                        localStorage.setItem("access_token", accessToken);
                        localStorage.setItem("expires_in", expirationTime);

                        // Redirect to the home route
                        router.push("/home");
                    } else {
                        error.value = res.data.message;
                    }
                });
        };
        return {
            form,
            login,
            error,
        };
    },
    methods: {},
};
</script>
