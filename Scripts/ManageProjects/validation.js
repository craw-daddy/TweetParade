function nospaces(t){

if(t.value.match(/\s/g)){

alert('Please enter a project name that does not contain a space. Thank you.');

t.value=t.value.replace(/\s/g,'');

}

}