// author : er-chandreshbhai r s
// contact : +91.900.4313.006 / er.chandreshbhai@gmail.com

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
        // processing an array
        inputArray.forEach(function(address){
            // parsing URL
            this.parsedUrl = url.parse(address, true);
            // selecting http OR https module
            this.protocolModuleType = (this.parsedUrl.protocol == 'https:' ? https : http);
            // obtaining urls
            this.protocol = this.parsedUrl.protocol;
            this.hostname = this.parsedUrl.hostname;
            this.port = (this.parsedUrl.port == null ? '' : this.parsedUrl.port);
            this.path = this.parsedUrl.path;
            // setting up requesting options
            var options = {
                protocol: this.protocol,
                hostname: this.hostname,
                port: this.port,
                path: this.path,
                method: 'GET'
            };
                // firing requests
                try{
                    this.protocolModuleType.get(this.parsedUrl,(resp) => {
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
                }
                catch(e){
                    this.log = address+' : '+e.name+ '('+e.message+ ')';
                    var currentTimeObj = new Date();
                    statusTimer(currentTimeObj, this.log); 
                    writeOutputFile(this.log);
                    this.errorResponseCount++;
                    this.responseCount++;
                    readOutputFile(this.responseCount);
                }
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
        console.log('Current Status [ '+responseCount+' / '+inputArray.length+' ] '+log);
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
// output file reading function
function readOutputFile(responseCount){
    if(responseCount == inputArray.length){
        writeOutputFile('\n==========================\n');
        writeOutputFile('Total Request : '+this.responseCount+'\n');
        writeOutputFile('successResponseCount  : '+this.successResponseCount+'\n');
        writeOutputFile('errorResponseCount : '+this.errorResponseCount+'\n');
        console.log('\n===========FinalResult===============\n');
        console.log('totalRequest : '+this.responseCount+'\n');
        console.log('successResponseCount  : '+this.successResponseCount+'\n');
        console.log('errorResponseCount : '+this.errorResponseCount+'\n');
        console.log('to see complete result open file [output.txt] \n');
        // fs.readFile('output.txt', 'utf8', function(err, contents) {
        //     if(err){
        //         console.log(err.message);
        //     }
        //     console.log(contents);
        // });
    }
}