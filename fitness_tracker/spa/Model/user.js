var mysql = require("mysql");

module.exports =  {
    blank: function(){ return {} },
    get: function(row, ret){
        var conn = GetConnection();
        var sql = 'SELECT * FROM FT_users';
        var criteria;
        if(!row) {}
        else if(row.login_name){
          sql += " where login_name = ?";
          criteria = row.login_name;
        }
        else if(row.screen_name){
          sql += " where screen_name = ?";
          criteria = row.screen_name;
        }
        conn.query(sql,[criteria], function(err,rows){
          ret(err,rows);
          conn.end();
        });        
    },
    delete: function(id, ret){
        var conn = GetConnection();
        conn.query("DELETE FROM FT_meals WHERE id = " + id, function(err,rows){
          ret(err);
          conn.end();
        });        
    },
    save: function(row, ret){
        var sql;
        var conn = GetConnection();
        //  TODO Sanitize
        if (row.id) {
				  sql = " Update FT_users "
							+ " Set name=?, password=? "
						  + " WHERE id = ? ";
			  }else{
				  sql = "INSERT INTO FT_users "
						  + " (login_name, name, password, create_time) "
						  + "VALUES (?, ?, ?, Now() ) ";				
			  }
        conn.query(sql, [row.login_name, row.name, row.password],function(err,data){
          if(!err && !row.id){
            row.id = data.insertId;
          }
          ret(err, row);
          conn.end();
        });        
    },
    validate: function(row){
      var errors = {};
      
      if(!row.name) errors.users = "is required"; 
      
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