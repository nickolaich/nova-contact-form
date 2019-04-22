<template>
    <div id="app">
        <div>
            <div class="pb-40" id="contact-form"></div>
            <div class="service-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 text-center pb-20">
                                <div class="portfolio-section">
                                    <h2>{{ $t('contacts.get_in_touch') }}</h2>
                                    <p class="section-overview" v-html="$t('contacts.overview', replacements)"></p>
                                </div>
                            </div>
                            <div class="conract-area-bottom">

                                <div class="alert alert-success" v-html="$t('contacts.sent', replacements)"
                                     v-show="successfullySent"></div>


                                <div class="alert alert-danger" v-html="$t('contacts.error', replacements)"
                                     v-show="errorSending"></div>

                                <form
                                        @submit="checkForm"
                                        action="/contact"
                                        id=""
                                        method="post"
                                        novalidate="true"
                                >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div :class='{"mt-20 mb-20 main-input " : true, "has-error":errors.name}'>
                                        <span
                                                class="help-block"
                                                v-if="errors.name">{{ $t('contacts.errors.name') }}</span>
                                                <input :placeholder="$t('contacts.fields.name')" name="name"
                                                       type="text"
                                                       v-model="form.name" value="">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div :class='{"mrg-eml mrg-contact main-input" : true, "has-error":errors.email}'>
                                        <span
                                                class="help-block"
                                                v-if="errors.email">{{ $t('contacts.errors.email') }}</span>
                                                <input :placeholder="$t('contacts.fields.email')" name="email"
                                                       type="email"
                                                       v-model="form.email" value="">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div :class='{"main-input" : true, "has-error":errors.phone}'>
                                        <span
                                                class="help-block"
                                                v-if="errors.phone">{{ $t('contacts.errors.phone') }}</span>
                                                <input :placeholder="$t('contacts.fields.phone')" name="phone"
                                                       type="text"
                                                       v-model="form.phone" value="">

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div :class='{"main-input mt-20 mb-20" : true, "has-error":errors.subject}'>
                                        <span
                                                class="help-block"
                                                v-if="errors.subject">{{ $t('contacts.errors.subject') }}</span>
                                                <input :placeholder="$t('contacts.fields.subject')" name="subject"
                                                       type="text"
                                                       v-model="form.subject" value="">

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div :class='{"text-leave2" : true, "has-error":errors.description}'>
                                        <span
                                                class="help-block" v-html="$t('contacts.errors.text')"
                                                v-if="errors.description"></span>
                                                <textarea :placeholder="$t('contacts.fields.message')"
                                                          name="text"
                                                          v-model="form.description"></textarea>

                                                <button
                                                        class="submit" type="submit">{{ $t('contacts.fields.send') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>


  import { mapActions, mapState } from 'vuex'

  export default {
    name: 'App',
    components: {},
    mixins: [],
    data () {
      return {
        form: {
          name: '',
          email: '',
          phone: '',
          subject: '',
          description: ''
        },
        errors: {},
        errorSending: false,
        successfullySent: false,
        replacements: {}
      }
    },
    mounted () {
    },
    methods: {
      ...mapActions({
        submitContactForm: 'submitContactForm'
      }),
      checkForm: function (e) {
        e.preventDefault()
        const form = this.form
        this.errors = {}
        if (form.name && (form.email && this.validEmail(form.email)) && form.phone) {
          this.errorSending = false
          this.submitContactForm(form)
            .then(() => {
              this.successfullySent = true
            })
            .catch(() => {
              this.errorSending = true
            })
        }
        if (!form.name) {
          this.errors.name = true
        }
        if (!form.email || !this.validEmail(form.email)) {
          this.errors.email = true
        }
        if (!form.phone) {
          this.errors.phone = true
        }
        return false
      },
      // Is it email
      validEmail: function (email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return re.test(email)
      }
    },

    watch: {
      'form.name': {
        handler (val) {
          this.errors.name = !val
        }
      },
      'form.email': {
        handler (val) {
          this.errors.email = !val || !this.validEmail(val)
        }
      },
      'form.phone': {
        handler (val) {
          this.errors.phone = !val
        }
      },
    },

  }
</script>


<style>
@import "~bootstrap/dist/css/bootstrap.css";

@import url('https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700|Lato:300,400,700');
@import "css/default.css";


</style>
