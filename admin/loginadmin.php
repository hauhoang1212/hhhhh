<h1>DANG NHAP TRANG QUAN TRI</h1>
       <section style="color:red;font-weight:bold;"> <?=isset($alert)?$alert:"" ?></section>
        <form method="post">
            <section>
                <label >Username:</label> <input  name="username" >
            </section>
            <section>
                <label >Password:</label> <input type="password" name="password" >
            </section>
            <section>
                <input type ="submit" value="dang nhap" >
            </section>
        </form>