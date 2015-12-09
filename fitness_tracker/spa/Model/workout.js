var mysql = require("mysql");

module.exports =  {
    blank: function(){ return {} },
    get: function(id, ret){
        var conn = GetConnection();
        var sql = 'SELECT * FROM FT_workouts ';
        if(id){
          sql += " WHERE id = " + id;
        }
        conn.query(sql, function(err,rows){
          ret(err,rows);
          conn.end();
        });        
    },
    delete: function(id, ret){
        var conn = GetConnection();
        conn.query("DELETE FROM FT_workouts WHERE id = " + id, function(err,rows){
          ret(err);
          conn.end();
        });        
    },
    save: function(row, ret){
        var sql;
        var conn = GetConnection();
        //  TODO Sanitize
        if (row.id) {
				  sql = " Update FT_workouts "
							+ " Set workout=?, time=?, calories=? "
						  + " WHERE id = ? ";
			  }else{
				  sql = "INSERT INTO FT_workouts "
						  + " (workout, time, calories, create_time) "
						  + "VALUES (?, ?, ?, Now() ) ";				
			  }
        conn.query(sql, [row.workout, row.time, row.calories, row.id],function(err,data){
          if(!err && !row.id){
            row.id = data.insertId;
          }
          ret(err, row);
          conn.end();
        });        
    },
    validate: function(row){
      var errors = {};
      
      if(!row.workout) errors.workout = "is required"; 
      
      return errors.length ? errors : false;
    }
};  

function GetConnection(){
        var conn = mysql.createConnection({
          host: "localhost",
          user: "jesse",
          password: "9221",
          database: "c9"
        });
    return conn;
}