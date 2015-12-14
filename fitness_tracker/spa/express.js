var express = require('express'),
    app = express();
var bodyParser = require('body-parser');
var meal = require("./Model/meal");
var user = require("./Model/user");
var workout = require("./Model/workout")
var unirest = require('unirest');
var OAuth = require('oauth').OAuth;
var Twit = require('twit');
var session = require('express-session');

console.log(__dirname + '/public');
app.use(express.static(__dirname + '/public'));
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(session({ secret: 'Ralph The Turtle', 
    resave: true,
    saveUninitialized: true,
}));
var oa = new OAuth(
      'https://api.twitter.com/oauth/request_token',
      'https://api.twitter.com/oauth/access_token',
      'OTWlM046UyDTJJVKWGfupTsIl',
      'nFCbhILGnZVg45uzIDXZ8bIGD7kxw5Ycum8Eip5mqTs1btZfvK',
      '1.0A',
      'https://cps493-deisingj1.c9users.io/auth/twitter/callback',
      'HMAC-SHA1'
    );
    
var twit;

app.get('/auth/twitter', function(req, res){
	oa.getOAuthRequestToken(function(error, oauth_token, oauth_token_secret, results){
		if (error) {
			console.log(error);
			res.send("yeah no. didn't work.")
		}
		else {
			req.session.oauth = {};
			req.session.oauth.token = oauth_token;
			console.log('oauth.token: ' + req.session.oauth.token);
			req.session.oauth.token_secret = oauth_token_secret;
			console.log('oauth.token_secret: ' + req.session.oauth.token_secret);
			res.send(req.session.oauth);
	}
	});
});

app.get('/auth/twitter/callback', function(req, res, next){
	if (req.session.oauth) {
		req.session.oauth.verifier = req.query.oauth_verifier;
		var oauth = req.session.oauth;

		oa.getOAuthAccessToken(oauth.token,oauth.token_secret,oauth.verifier, 
		function(error, oauth_access_token, oauth_access_token_secret, results){
			if (error){
				console.log(error);
				res.send("Error logging in.");
			} else {
				req.session.oauth.access_token = oauth_access_token;
				req.session.oauth.access_token_secret = oauth_access_token_secret;
				twit = new Twit({
           consumer_key:         'OTWlM046UyDTJJVKWGfupTsIl'
         , consumer_secret:      'nFCbhILGnZVg45uzIDXZ8bIGD7kxw5Ycum8Eip5mqTs1btZfvK'
         , access_token:         oauth_access_token
         , access_token_secret:  oauth_access_token_secret
        })
        user.get(results, function(err,rows){
          if(!rows[0]){
            user.save(results, function(err, rows) {
              user.get(results, function(err,rows) {
                req.session.user = rows[0];
                res.redirect("/#/meal");
                res.end();               
              })
            })
          }
          else {
            req.session.user = rows[0];
   				  res.redirect("/#/meal");
  				  res.end();
          }
        })
		}
		});
	} else
		next(new Error("This is not a page you were supposed to find...."))
});

app.get("/meal", function(req, res){
  if(req.session.user) {
    meal.get(null, req.session.user.id, function(err, rows){
      res.send(rows);
    })
  }
})
.get("/currentUser", function(req, res){
  if(req.session.user) {
    res.send(req.session.user);
  }
  else {
    res.send({
      name: 'Guest'
    });
  }
})
.get("/meal/:id", function(req, res){
  
  meal.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
})
.get("/meal/find/:name", function(req, res){
  meal.search(req.params.name, function(err, rows) {
    res.send(rows);
  })
})
.post("/meal", function(req, res){
  console.log(req.session.user);
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
  if(twit) {
    twit.post('statuses/update', { status: 'I exercised by ' + req.body.workout + ' and burned ' + req.body.calories + ' calories!'}, function(err, data, response) {
      console.log(data)
    })
  }
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
    res.send(rows[0]);
  })
})
app.listen(process.env.PORT);