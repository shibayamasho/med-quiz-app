import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Vue
import { createApp } from 'vue/dist/vue.esm-bundler';

var pathname= location.pathname;
// console.log(pathname); //debug

// 問題登録画面の場合
if (pathname == '/quiz/edit') {
    const choices = {
        data() {
            return {
                choices: 2, // 問題の選択肢の数
            }
        }
    }
    createApp(choices).mount('#app')
}

