<template>
    <Head title="Registrati" />
    <app-layout title="Dashboard">

        <jet-authentication-card>

            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <jet-label for="business_name" value="Ragione sociale" />
                    <jet-input id="business_name" type="text" class="mt-1 block w-full" v-model="form.business_name" required autocomplete="name" />
                </div>
                <div class="mt-4">
                    <jet-label for="business_email" value="Email aziendale" />
                    <jet-input id="business_email" type="email" class="mt-1 block w-full" v-model="form.business_email" required autocomplete />
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
                        Aggiorna
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
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

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
        props: ['company', 'user'],
        setup(props){
            const form = useForm({
                _method: "PUT",
                name: props.user.name,
                email: props.user.email,
                business_email: props.company.business_email,
                business_name: props.company.business_name,
                address: props.company.address,
                cap: props.company.cap,
                city: props.company.city,
                province: props.company.province, 
                region: props.company.region,
            });
            const updateInformation = () =>{
                form.value.post(route("users.update"), {
                    preserveScroll: true,
                });
            };
            return {form, updateInformation}
        },
        data() {
            return {
                form: this.$inertia.form({
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('company.update', user))
            }
        }
    })

</script>