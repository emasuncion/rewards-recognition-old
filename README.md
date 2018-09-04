# Global Education Rewards & Recognition

### If using Laradock
- Build the image using ``` docker-compose up -d --build nginx mysql workspace ```
- Go inside the mysql container
- Then run these commands:
```
    CREATE USER 'admin'@'localhost' IDENTIFIED WITH mysql_native_password BY 'yourpass';
    GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION;
    CREATE USER 'admin'@'%' IDENTIFIED WITH mysql_native_password BY 'yourpass';
    GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' WITH GRANT OPTION;
```
