import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Vue
import { createApp } from 'vue/dist/vue.esm-bundler';

// // 問題解答ボタン
// const QuizChallenge = {
//     data() {
//         return {
//             correctAnswer: false,
//             incorrectAnswer: false,
//         }
//     },
//     methods: {
//         answer(value){
//             // console.log('クリックされた');
//             // this.correctAnswer = true;
//         }
//     }
// }
// createApp(QuizChallenge).mount("#quizChallenge");