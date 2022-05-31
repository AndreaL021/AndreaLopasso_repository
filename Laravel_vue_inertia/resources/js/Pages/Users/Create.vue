<template>
    <Head title="Registrati" />
    <app-layout title="Dashboard">

        <jet-authentication-card>

            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <jet-label for="name" value="Ragione sociale" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.business_name" required autocomplete="name" />
                </div>
                <div class="mt-4">
                    <jet-label for="email" value="Email aziendale" />
                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.business_email" required autocomplete />
                </div>
                <div class="mt-4">
                    <jet-label for="address" value="Indirizzo" />
                    <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" required autocomplete />
                </div>
                <div class="mt-4">
                    <jet-label for="region" value="Regione" />
                    <jet-input id="region" type="text" class="mt-1 block w-full" v-model="form.region" required autocomplete />
                </div>
                <div class="mt-4">
                    <jet-label for="province" value="Provincia" />
                    <jet-input id="province" type="text" class="mt-1 block w-full" v-model="form.province" required autocomplete />
                </div>
                <div class="mt-4">
                    <jet-label for="city" value="Città" />
                    <jet-input id="city" type="text" class="mt-1 block w-full" v-model="form.city" required autocomplete />
                </div>
                <div class="mt-4">
                    <jet-label for="cap" value="CAP" />
                    <jet-input id="cap" maxlength="5" type="number" class="mt-1 block w-full" v-model="form.cap" required autocomplete />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Registrati
                    </jet-button>
                </div>
            </form>
        </jet-authentication-card>
    </app-layout>
</template>


<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
            AppLayout,
        },
        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    business_email:'',
                    business_name:'',
                    address:'',
                    cap: '',
                    city:'',
                    province:'', 
                    region:'',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('users.store'),)
            }
        }
    })

</script>
