import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import Button from '@/components/Button.vue'
import Footer from '@/components/Footer.vue'
import Input from '@/components/Input.vue'

const app = createApp(App)

app.component('Footer', Footer)
  .component('Input', Input)
  .component('Button', Button)

app.use(createPinia())
app.use(router)

app.mount('#app')
