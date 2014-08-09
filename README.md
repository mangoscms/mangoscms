## ManGOSCMS ##

Follow this steps to install MaNGOSCMS successfully:

**1)** Download all the files from this repo (`mangoscms/mangoscms`) and the repo `mangoscms/Database`
**2)** Create a database for MaNGOSCMS. You are free in the choice of the database's name.
**3)** Import the file `mangoscms.sql` into your previously created database.
**4)** Upload the files from the repo `mangoscms/mangoscms` to your webserver. Put the directory `public` in the `htdocs/www` directory. All other directories and files should be moved outside your public accessible `htdocs/www` directory.
**5)** Configure the usernames and passwords for the databases accesses in the file `app/config/database.php`.
**6)** Set a 32 char long random string as the encryption key under `'key' => '',`.

**You are ready to go. Have fun with MaNGOSCMS!**
