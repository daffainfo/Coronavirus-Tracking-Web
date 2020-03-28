const startButton = document.getElementById('start-btn')

//Question & Answer
const questionContainerElement = document.getElementById('question-container')
const questionElement = document.getElementById('question')
const answerButtonsElement = document.getElementById('answer-buttons')

//Results
const resultContainerElement = document.getElementById('result-container') 
const resultKondisi = document.getElementById('kondisi')
const resultProsedur = document.getElementById('prosedur')
const resultPSign = document.getElementById('prosedur-sign')


let currentQuestionIndex, restart = 0
let currentKondisi, currentProsedur

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });

startButton.addEventListener('click', startTest)

function startTest() {
    startButton.classList.add('hide')
    questionContainerElement.classList.remove('hide')
    currentQuestionIndex = 0
    if(restart){
        resultContainerElement.classList.add('hide')
    }
    else {resultContainerElement.classList.add('hide')}
    setNextKondisi()
}

function setNextKondisi() {
    removeChild()
    showKondisi(result_kondisi[currentQuestionIndex])
}

function setNextGejala() {
    removeChild()
    showGejala(result_gejala[0])
}

function showKondisi(question) {
    questionElement.innerHTML = question.question
    question.answers.forEach(answer => {
        const button = document.createElement('button')
        buttonAddClass(button, answer)
        button.dataset.next = answer.next
        button.dataset.kondisi = answer.kondisi
        button.addEventListener('click', selectAnswerKondisi)
        answerButtonsElement.appendChild(button)
    });
}


function showGejala(question) {
    questionElement.innerHTML = question.question
    question.answers.forEach(answer => {
        const button = document.createElement('button')
        buttonAddClass(button, answer)
        button.dataset.prosedur = answer.prosedur
        button.addEventListener('click', selectAnswerGejala)
        answerButtonsElement.appendChild(button)
    });
}

function selectAnswerKondisi(e) {
    const selectedButton = e.target
    const next = selectedButton.dataset.next
    const kondisi = selectedButton.dataset.kondisi
    
    if(kondisi == 0){
        currentQuestionIndex = next
        setNextKondisi()
    }else{
        currentKondisi = kondisi
        setNextGejala()
    }
}

function selectAnswerGejala(e) {
    const selectedButton = e.target
    const prosedur = selectedButton.dataset.prosedur
    const index = 2*currentKondisi
    
    currentProsedur = prosedur[index]
    resultAll()
}

function resultAll(){
    removeChild()
    questionContainerElement.classList.add('hide')
    resultContainerElement.classList.remove('hide')
    showResult()
    restart = 1
    
    startButton.innerText = 'Tes Ulang'
    startButton.classList.remove('hide')
}

function buttonAddClass(button, answer) {
    button.innerText = answer.text
    button.classList.add('btn')
    button.classList.add('btn-outline-primary')
}

function showResult() {
    switch (currentKondisi) {
        case "1":
            resultKondisi.innerHTML = 'Kondisi 1 : Risiko tinggi tertular COVID 19'
            break;
        case "2":
            resultKondisi.innerHTML = 'Kondisi 2 : Kelompok kuat dengan risiko tertular'
            break;
            case "3":
                resultKondisi.innerHTML = 'Kondisi 3 : Kelompok rentan mengalami kritikal kondisi saat tertular'
            break;
        case "4":
            resultKondisi.innerHTML = 'Kondisi 4 : Kelompok kuat dengan risiko tertular sangat rendah'
            break;

        default:
            break;
    }
    
    switch (currentProsedur){
        case "1":
            resultProsedur.innerHTML = 'Prosedur 1 : Sebaiknya melapor ke 119'
            setPopAtt(resultPSign, "Anda diharuskan segera memeriksakan diri di rumah sakit terdekat")
            break;
        case "2":
            resultProsedur.innerHTML = 'Prosedur 2 : Sebaiknya isolasi dan jangan keluar selama 14 hari, dengan menimbang gejala yang muncul kemudian'
            setPopAtt(resultPSign, "Anda mungkin menjadi carrier COVID 19, diharapkan untuk tetap di rumah sekaligus menjaga jarak dengan keluarga")
            break;
        case "3":
            resultProsedur.innerHTML = 'Prosedur 3 : Direkomendasikan untuk selalu di rumah selama pandemi berlangsung'
            setPopAtt(resultPSign, "Anda berpeluang besar mengalami kondisi kritis jika terkena COVID 19, mohon menahan diri selama pandemi")
            break;
        case "4":
            resultProsedur.innerHTML = 'Prosedur 4 : Diperbolehkan keluar selama memberlakukan social distancing'
            setPopAtt(resultPSign, "Meski Anda sehat, peluang Anda membahayakan orang lain tetap tinggi! Jaga jarak, sebisa mungkin mengurangi kegiatan di luar")
            break;
        default:
            break;
    }
}

function setPopAtt(data, str){
    data.setAttribute("data-content", str)
}

function removeChild() {
    while (answerButtonsElement.firstChild) {
        answerButtonsElement.removeChild(answerButtonsElement.firstChild)
    }
}


const result_kondisi = [
    {
        question: 'Umurmu kurang dari 60 tahun?',
        answers: [
            { text: 'YA', next: 1, kondisi: 0 },
            { text: 'TIDAK', next: 6, kondisi: 0 },
        ]
    },
    {
        question: 'Apakah pernah melakukan kontak dengan penderita/negara terdampak?',
        answers: [
            { text: 'YA', next: 0, kondisi: 1 },
            { text: 'TIDAK', next: 2, kondisi: 0 },
        ]
    },
    {
        question: 'Dalam kurang 7 hari, mengikuti kegiatan yang melibatkan orang banyak?',
        answers: [
            { text: 'YA', next: 3, kondisi: 0 },
            { text: 'TIDAK', next: 5, kondisi: 0 },
        ]
    },
    {
        question: 'Terdapat riwayat kesehatan yang berat/pasca pemulihan?',
        answers: [
            { text: 'YA', next: 4, kondisi: 0 },
            { text: 'TIDAK', next: 0, kondisi: 2 },
        ]
    },
    {
        question: 'Apakah daerahmu termasuk zona merah COVID 19?',
        answers: [
            { text: 'YA', next: 0, kondisi: 1 },
            { text: 'TIDAK', next: 0, kondisi: 3 },
        ]
    },
    {
        question: 'Terdapat riwayat kesehatan yang berat/pasca pemulihan?',
        answers: [
            { text: 'YA', next: 0, kondisi: 3 },
            { text: 'TIDAK', next: 0, kondisi: 4 },
        ]
    },
    {
        question: 'Apakah pernah melakukan kontak dengan penderita/negara terdampak?',
        answers: [
            { text: 'YA', next: 0, kondisi: 1 },
            { text: 'TIDAK', next: 0, kondisi: 3 },
        ]
    }
]

const result_gejala = [
    {
        question: 'Apakah Anda mengalami gejala-gejala berikut?<br>1) Demam 2) Batuk kering 3) Sesak nafas',
        answers: [
            { text: 'SAYA MENGALAMI KETIGANYA', prosedur: [0, 1, 1, 2, 2] },
            { text: 'HANYA SALAH SATU', prosedur: [0, 2, 2, 3, 2] },
            { text: 'TIDAK SEMUANYA', prosedur: [0, 2, 2, 3, 4] }
        ]
    },
]