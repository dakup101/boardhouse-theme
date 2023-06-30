import crypto from "node:crypto";
import FormData from "form-data";
import fetch from "node-fetch";

const systemKey = test_test();
const apiUrl = "https://client8748.idosell.com/api/objects/getAll/24/json";
const login = "dev@hooves.pl";
const lang = "pol";

ido_getAll();

function test_test() {
	const formatYmd = (date) => date.toISOString().slice(0, 10);
	let date= formatYmd(new Date());

	const ymd = date.replace("-", "").replace("-", "");
	const pwd = "HoovesWOW657";


	const hashPwd = crypto.createHash("sha1").update(pwd).digest("hex");
    const systemKey = crypto.createHash("sha1").update(ymd+hashPwd).digest("hex");
	console.log(systemKey);
    return systemKey;
}

function ido_getAll(){
    const data = new FormData();
	fetch(apiUrl, {
		method: "POST",
		body: data,
		credentials: "same-origin",
        headers: {
            'Content-type' : 'application/json;charset=UTF-8',
            'Accept' : 'application/json',
            'authenticate' : {
                'systemKey' : systemKey,
                'systemLogin' : login,
                'lang' : 'pol'
            }
        }
	})
    .then((response) => response.json())
    .then((json) => {
        console.log(json)
    });
}