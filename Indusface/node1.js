// required modules
const fs = require('fs');
const url = require('url');
const http = require('http');
const https = require('https');
responseCount = 0;
errorResponseCount = 0;
successResponseCount = 0;
var targetTimeObj = new Date(); 
targetTimeObj = new Date(targetTimeObj.getTime() + 1000*2);
try{
    // refreshing output file
    fs.unlink('output.txt',function(err){});
    // reading input file
    console.log('\nreading file \n');
    fs.readFile('input.txt', 'utf8', function(err, contents) {
        if(err){
            console.log(err.message);
            return false;
        }
        // storing file into an array
        console.log('processing file \n');
        inputArray = contents.split("\n");
        // loop through an array
        inputArray.forEach(function(address){
            // parsing URL
            this.parsedUrl = url.parse(address, true);
            // obtaining protocol
            this.protocol = (this.parsedUrl.protocol == 'https:' ? https : http);
            // requesting address
            this.protocol.get(address,(resp) => {
                this.log = address+' : '+resp.statusMessage+' = '+resp.statusCode;
                var currentTimeObj = new Date();
                statusTimer(currentTimeObj, this.log);     
                writeOutputFile(this.log);
                this.successResponseCount++;
                this.responseCount++;
                readOutputFile(this.responseCount);
            }).on('error',(err)=>{
                this.log = address+' : '+err.name+ '('+err.message+ ')';
                var currentTimeObj = new Date();
                statusTimer(currentTimeObj, this.log); 
                writeOutputFile(this.log);
                this.errorResponseCount++;
                this.responseCount++;
                readOutputFile(this.responseCount);
            });
        });
    });
    return false;
}
catch(e)
{
    console.log(e.message);
    return false;
}
// it triggers after every 2 seconds to show current status
function statusTimer(currentTimeObj, log){
    if(targetTimeObj.getSeconds() == currentTimeObj.getSeconds()){
        console.log('Current Status >> '+log);
        targetTimeObj = new Date(); 
        targetTimeObj = new Date(targetTimeObj.getTime() + 1000*2);
    }   
}
// output file writting function
function writeOutputFile(log){
    fs.appendFileSync('output.txt',log+'\n', function(err){
        if(err){
            console.log(err.message);
        }
    });
}
// output file read function
function readOutputFile(responseCount){
    if(responseCount == inputArray.length){
        writeOutputFile('\n==========================\n');
        writeOutputFile('Total Request : '+this.responseCount+'\n');
        writeOutputFile('successResponseCount  : '+this.successResponseCount+'\n');
        writeOutputFile('errorResponseCount : '+this.errorResponseCount+'\n');
        console.log('\n===========FinalResult===============\n');
        fs.readFile('output.txt', 'utf8', function(err, contents) {
            if(err){
                console.log(err.message);
            }
            console.log(contents);
        });
    }
}