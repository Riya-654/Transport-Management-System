var express = require("express")
var bodyParser = require("body-parser")
var mongoose = require("mongoose")
const User=require('./user.js')
const Bhk=require('./aptbhk.js')
const Bhk1=require('./aptbhk1.js')
const Apt2=require('./apt2bhk.js')
const Slot=require('./slot.js')
const Slot2=require('./slot2.js')

const app = express()

app.use(bodyParser.json())

app.use(express.static('public'))
app.use(bodyParser.urlencoded({
    extended:true
}))

mongoose.connect('mongodb://localhost:27017/Apartment_Booking',{
    useNewUrlParser: true,
    useUnifiedTopology: true,
});

var db = mongoose.connection;

db.on('error',()=>console.log("Error in Connecting to Database"));
db.once('open',()=>console.log("Connected to Database"))


app.post("/feed-back",async(req,res)=>{
    var name = req.body.name;
    var email = req.body.email;
    var subj = req.body.subj;
    var message = req.body.message;
	
	if(!name||!email||!subj||!message)
		return res.json({status:'error',error:'Some Fields are Empty'})

    var data1 = {
        "name": name,
        "email" : email,
        "subject": subj,
        "message" : message
    }

    db.collection('feedback').insertOne(data1,(err,collection)=>{
        if(err){
            return res.json({status:'error',error:'some error has occured'})
        }
        console.log("Record Inserted Successfully");
		return res.json({status:'ok',data:'Feedback Sent!'})
    });

})

app.post("/user-signup",async (req,res)=>{
    var fname = req.body.fname;
    var lname = req.body.lname;
	var uname = req.body.uname;
    var email = req.body.email;
    var phno = req.body.phn;
    var psw = req.body.password;
	var repp=req.body.repp;
	
	if(psw.length<6)
	{
		return res.json({status:'error',error:'Password should have atleast 6 characters'})
	}
	if(psw!=repp)
	{
		//console.log('passwords dont match');
		return res.json({status:'error',error:'passwords dont match'})
	}
    var data2 = {
        "First_Name": fname,
        "Last_Name": lname,
		"username":uname,
		"Email": email,
		"Phone_no":phno,
		"password":psw
    }

    db.collection('users').insertOne(data2,(err,collection)=>{		
		
		if(err){
			if(err.code===11000){ 
			return res.json({status:'error',error:'Username already exist'})}
			
			console.log(err);
			return res.json({status:'error',error:'some error has occured'})
		
		}
		else{
			return res.json({status:'ok',data:'datasuccess'})
		}
			
    });
	
})
app.post('/signup',async(req,res)=>{
	
	const {username,password}=req.body
	
	const user=await User.findOne({username,password}).lean()
	if(!user){
		return res.json({status:'error',error:'Invalid User/password'})
	}
	
	res.json({status:'ok',data:'abcdef'})
})

app.post('/bhk-selec',async(req,res)=>{
	var bhk= req.body.b;
	const enq=await Bhk.findOne({bhk,count:"0"})
	if(enq){
		return res.json({status:'error',error:'Not Available'})
	}
	
	res.json({status:'ok',data:'abcdef'})
})
app.post('/bhk-selec2',async(req,res)=>{
	var bhk= req.body.b;
	const enq=await Apt2.findOne({bhk,count:"0"})
	if(enq){
		return res.json({status:'error',error:'Not Available'})
	}
	
	res.json({status:'ok',data:'abcdef'})
})
app.post('/bhk-selec1',async(req,res)=>{
	var bhk= req.body.b;
	var vv= req.body.v;
	if(vv=='e')
	{
		const enq=await Bhk1.findOne({bhk,count:"0"})
		if(enq){
		return res.json({status:'error',error:'Not available'})
		}
		else{
			
			const enq1=await Bhk1.findOne({bhk,east:"0"})
			if(enq1){
		return res.json({status:'error',error:'East Facing Not Available '})
		}
		}
	}
	else
	{
		const enq=await Bhk1.findOne({bhk,count:"0"})
		if(enq){
		return res.json({status:'error',error:'Not available'})
		}
		else{
			
			const enq1=await Bhk1.findOne({bhk,north:"0"})
			if(enq1){
		return res.json({status:'error',error:'North Facing Not Available '})
		}
		}
	
	}

	
	res.json({status:'ok',data:'abcdef'})
})
app.post('/bhk-selec12',async(req,res)=>{
	var bhk= req.body.b;
	var vv= req.body.v;
	if(vv=='e')
	{
		const enq=await Apt2.findOne({bhk,count:"0"})
		if(enq){
		return res.json({status:'error',error:'Not available'})
		}
		else{
			
			const enq1=await Apt2.findOne({bhk,east:"0"})
			if(enq1){
		return res.json({status:'error',error:'East Facing Not Available '})
		}
		}
	}
	else
	{
		const enq=await Apt2.findOne({bhk,count:"0"})
		if(enq){
		return res.json({status:'error',error:'Not available'})
		}
		else{
			
			const enq1=await Apt2.findOne({bhk,north:"0"})
			if(enq1){
		return res.json({status:'error',error:'North Facing Not Available '})
		}
		}
	
	}

	
	res.json({status:'ok',data:'abcdef'})
})
app.post('/confirmation',async(req,res)=>{
	var name = req.body.name;
    var email = req.body.email;
    var date = req.body.date;
    var slot = req.body.slot;

	const enq=await Slot.findOne({email})
	if(enq){
		return res.json({status:'error',error:'Slot is Already Booked'})
	}
	
	//res.json({status:'ok',data:'okayy'})

    var data3 = {
        "name": name,
        "email" : email,
        "date": date,
        "slot" : slot
    }

    db.collection('booked_slots').insertOne(data3,(err,collection)=>{
        if(err){
            return res.json({status:'error',error:'some error has occured'})
        }
        console.log("Slot added");
		return res.json({status:'ok',data:'Slot Booked'})
    });
})
app.post('/confirmation2',async(req,res)=>{
	var name = req.body.name;
    var email = req.body.email;
    var date = req.body.date;
    var slot = req.body.slot;

	const enq=await Slot2.findOne({email})
	if(enq){
		return res.json({status:'error',error:'Slot is Already Booked'})
	}
	
	//res.json({status:'ok',data:'okayy'})

    var data3 = {
        "name": name,
        "email" : email,
        "date": date,
        "slot" : slot
    }

    db.collection('booked_slots2').insertOne(data3,(err,collection)=>{
        if(err){
            return res.json({status:'error',error:'some error has occured'})
        }
        console.log("Slot added");
		return res.json({status:'ok',data:'Slot Booked'})
    });
})

app.listen(9999,()=>{
	console.log('Server at 9999')
})



