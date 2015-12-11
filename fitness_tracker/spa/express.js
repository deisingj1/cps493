var express = require('express'),
    app = express();
var bodyParser = require('body-parser');
var meal = require("./Model/meal");
var user = require("./Model/user");
var workout = require("./Model/workout")
var unirest = require('unirest');
var OAuth = require('oauth');
var Twit = require('twit');
var session = require('express-session');
var loggedInUser;

console.log(__dirname + '/public');
app.use(express.static(__dirname + '/public'));
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(session({ secret: 'Ralph The Turtle', 
    resave: true,
    saveUninitialized: true,
}));
var oauth = new OAuth.OAuth(
      'https://api.twitter.com/oauth/request_token',
      'https://api.twitter.com/oauth/access_token',
      'OTWlM046UyDTJJVKWGfupTsIl',
      'nFCbhILGnZVg45uzIDXZ8bIGD7kxw5Ycum8Eip5mqTs1btZfvK',
      '1.0A',
      null,
      'HMAC-SHA1'
    );
    
var twit = new Twit({
    consumer_key:         'OTWlM046UyDTJJVKWGfupTsIl'
  , consumer_secret:      'nFCbhILGnZVg45uzIDXZ8bIGD7kxw5Ycum8Eip5mqTs1btZfvK'
  , access_token:         '2898507165-u1BC0kegroQv22OlHdJHLwf291hlxjUWhFlEQQi'
  , access_token_secret:  'VPTMSQwi0mjbpRajD8Ziv8AFPKIvPlfqGy5qkjQMGicop'
})

app.get("/meal", function(req, res){
  if(req.session.user) {
    meal.get(null, req.session.user.id, function(err, rows){
      res.send(rows);
    })
  }
})
.get("/currentUser", function(req, res){
    res.send(loggedInUser);
})
.get("/meal/:id", function(req, res){
  
  meal.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
  
})
.post("/meal", function(req, res){
  var errors = meal.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  meal.save(req.body, req.session.user.id, function(err, row){
    res.send(row);
  })
})
.delete("/meal/:id", function(req, res){
  
  meal.delete(req.params.id, function(err, rows){
      if(err){
        res.status(500).send(err);
      }else{
        res.send(req.params.id);
      }
  })
  
})
.get("/meal/search/:term", function(req, res){
    unirest.get("https://nutritionix-api.p.mashape.com/v1_1/search/" + req.params.term + "?fields=item_name%2Citem_id%2Cbrand_name%2Cnf_calories%2Cnf_total_fat")
    .header("X-Mashape-Key", "IGZgTggKMnmshgiyqWWrppKxwDR0p1FvHGAjsngCvRgN3P5X6V")
    .header("Accept", "application/json")
    .end(function (result) {
        res.send(result.body);
    });
})
app.get("/workout", function(req, res){
  if(req.session.user) {
    workout.get(null, req.session.user.id, function(err, rows){
      res.send(rows);
    })
  }
})
.get("/workout/:id", function(req, res){
  
  workout.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
  
})
.post("/workout", function(req, res){
  var errors = workout.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  workout.save(req.body, req.session.user.id, function(err, row){
    res.send(row);
  })
  twit.post('statuses/update', { status: 'I exercised by ' + req.body.workout + ' and burned ' + req.body.calories + ' calories!'}, function(err, data, response) {
    console.log(data)
  })
})

.delete("/workout/:id", function(req, res){
  
  workout.delete(req.params.id, function(err, rows){
      if(err){
        res.status(500).send(err);
      }else{
        res.send(req.params.id);
      }
  })
})
app.get("/user", function(req, res){
  user.get(null, function(err, rows){
    res.send(rows);
  })
})
.get("/user/:id", function(req, res){
  user.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
})
.post("/user", function(req, res){
  var errors = user.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  console.log(req.body);
  user.save(req.body, function(err, row){
    res.send(row);
  })
})
.post("/login", function(req, res){
  user.get(req.body, function(err,rows){
    req.session.user = rows[0];
    loggedInUser = req.session.user;
    console.log(loggedInUser);
    res.send(rows[0]);
  })
})
app.listen(process.env.PORT);