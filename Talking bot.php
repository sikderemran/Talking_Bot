<!DOCTYPE html>
<html>
<head>
<title>bot</title>
<style>
body { 
	color: #421; font-weight: bold; font-size: 18px; 
}
span { 
	color: #711; 
} 
::-webkit-input-placeholder { 
	color: #711 
}
#main { 
	position: fixed; top: 30%; right: 377px; width: 400px; 
	border: 0px solid #421; padding: 40px; 
}
#main div { 
	margin: 10px; 
} 
#input { 
	padding: 10px;
	 background-color: #110022;
	color: #004499;
	border-radius: 5px;
	margin-left: 94px;
}
h1{
	background-color: #110022;
	text-align: center;
	color: #004499;
	border-radius: 5px;
}

select{
	padding: 10px;
	margin-left: 28px;
	background-color: #110022;
	color: #004499;
	border-radius: 5px;
}
</style>
</head>
<body>
<div id="main">
	<h1>Talking Bot</h1>
	<div class="option">
		<label for="voice">Voice</label>
		<select name="voice" id="voice"></select>
	</div>
	<div>user: <span id="user"></span></div>
	<div>bot: <span id="chatbot"></span></div>
	<div><input id="input" type="text" placeholder="say anything..." autocomplete="off"/></div>
</div>
<script type="text/javascript">
var trigger = [
	["hi","hey","hello"], 
	["how are you", "how is life", "how are things"],
	["what are you doing", "what is going on"],
	["how old are you"],
	["who are you", "are you human", "are you bot", "are you human or bot","tell me about yourself"],
	["who created you", "who made you"],
	["your name please",  "your name", "may i know your name", "what is your name"],
	["i love you"],
	["happy", "good"],
	["bad", "bored", "tired"],
	["help me", "tell me story", "tell me joke"],
	["ah", "yes","ok", "okay", "nice", "thanks", "thank you"],
	["bye", "good bye", "goodbye", "see you later"],
    ["what is ai","what is Artificial Intelligence"],
    ["what language are you written in"],
    ["what is a computer","what is computer"],
    ["why can not you eat food","why can not you eat"]
    
    
];
var reply = [
	["Hi","Hey","Hello"], 
	["Fine", "Pretty well", "Fantastic"],
	["Nothing much", "About to go to sleep", "Can you guest?", "I don't know actually"],
	["I am 7 day old"],
	["I am just a bot", "I am a bot. What are you?"],
	["my creator are md emran sikder","md emran sikder"],
	["I am nameless", "I don't have a name"],
	["I love you too", "Me too"],
	["Have you ever felt bad?", "Glad to hear it"],
	["Why?", "Why? You shouldn't!", "Try watching TV"],
	["I will", "What about?"],
	["Tell me a story", "Tell me a joke", "Tell me about yourself", "You are welcome"],
	["Bye", "Goodbye", "See you later"],
    ["Artificial Intelligence is the branch of engineering and science devoted to constructing machines that think."],
    ["php and javascript"],
    ["A computer is an electronic device which takes information in digital form and performs a series of operations based on predetermined instructions to give some output."],
    ["because I'm a software programs"]
    
    
];
var alternative = ["sorry i am still learning beacause i am few days old"];
document.querySelector("#input").addEventListener("keypress", function(e){
	var key = e.which || e.keyCode;
	if(key === 13){ //Enter button
		var input = document.getElementById("input").value;
		document.getElementById("user").innerHTML = input;
		output(input);
	}
});
function output(input){
	try{
		var product = input + "=" + eval(input);
	} catch(e){
		var text = (input.toLowerCase()).replace(/[^\w\s\d]/gi, ""); //remove all chars except words, space and 
		text = text.replace(/ a /g, " ").replace(/i feel /g, "").replace(/whats/g, "what is").replace(/please /g, "").replace(/ please/g, "");
		if(compare(trigger, reply, text)){
			var product = compare(trigger, reply, text);
		} else {
			var product = alternative[Math.floor(Math.random()*alternative.length)];
		}
	}
	document.getElementById("chatbot").innerHTML = product;
	speak(product);
	document.getElementById("input").value = ""; //clear input value
}
function compare(arr, array, string){
	var item;
	for(var x=0; x<arr.length; x++){
		for(var y=0; y<array.length; y++){
			if(arr[x][y] == string){
				items = array[x];
				item =  items[Math.floor(Math.random()*items.length)];
			}
		}
	}
	return item;
}
var voiceSelect = document.getElementById('voice');
function loadVoices() {
	var voices = speechSynthesis.getVoices();
	voices.forEach(function(voice, i) {
		var option = document.createElement('option');
		option.value = voice.name;
		option.innerHTML = voice.name;
		voiceSelect.appendChild(option);
	});
}
loadVoices();
window.speechSynthesis.onvoiceschanged = function(e) {
  loadVoices();
};
function speak(string){
	var utterance = new SpeechSynthesisUtterance();
	utterance.voice = speechSynthesis.getVoices().filter(function(voice){return voice.name == voiceSelect.value;;})[0];
	utterance.text = string;
	utterance.lang = "en-US";
	utterance.volume = 1; //0-1 interval
	utterance.rate = 1;
	utterance.pitch = 2; //0-2 interval
	speechSynthesis.speak(utterance);
}
</script>
</body>
</html>