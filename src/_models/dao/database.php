<?php
class Database
{
    public static function ensureDatabaseCreated()
    {
        mysqli_report(MYSQLI_REPORT_OFF);
        $c = new mysqli(
            $_ENV["WSM_DBHELPER_SERVER"],
            $_ENV["WSM_DBHELPER_USERNAME"],
            $_ENV["WSM_DBHELPER_PASSWORD"]
        );
        if ($e = $c->connect_error)
            throw new Exception("Connection failed: $e");

        $sql = "CREATE DATABASE " . $_ENV["WSM_DBHELPER_DATABASE"];
        $result = !$c->query($sql);
        $c->close();
        return $result;
    }

    public static function connectDatabase()
    {
        mysqli_report(MYSQLI_REPORT_OFF);
        $r = new mysqli(
            $_ENV["WSM_DBHELPER_SERVER"],
            $_ENV["WSM_DBHELPER_USERNAME"],
            $_ENV["WSM_DBHELPER_PASSWORD"],
            $_ENV["WSM_DBHELPER_DATABASE"]
        );
        if ($e = $r->connect_error)
                throw new Exception("Connection failed: $e");
        echo($r->connect_error);
        return $r;
    }
    public static function executeQuery($sql, $params = null)
    {
        $con = Database::connectDatabase();
        $command = $con->prepare($sql);

        // xử lí các param truyền vào 
        if ($params != null) {
            $types = "";
            $values = array();
            foreach ($params as $field => $value) {
                if (is_float($value)) {
                    $types .= "d";
                } elseif (is_integer($value)) {
                    $types .= "i";
                } elseif (is_string($value)) {
                    $types .= "s";
                } else {
                    $types .= "b";
                }
                array_push($values, $value);
            }
            $command->bind_param($types, ...$values); // Gán giá trị tham số
        }
        // thực thi câu truy vấn
        if ($command->execute()) {
            $command->store_result();
            // lấy kết quả từ câu truy vấn
            $variables = [];
            $data = [];
            $meta = $command->result_metadata();
            while ($field = $meta->fetch_field())
                $variables[] = &$data[$field->name];
            call_user_func_array(array($command, 'bind_result'), $variables);
            $i = 0;
            $result = null;
            while ($command->fetch()) {
                $result[$i] = array();
                foreach ($data as $k => $v)
                    $result[$i][$k] = $v;
                $i++;
            }
            return $result;
        } else {
            return null;
        }
        $command->close();
        $con->close();
    }

    public static function executeNonQuery($sql, $params = null)
    {
        $con = Database::connectDatabase();
        $command = $con->prepare($sql);
        // xử lí các param truyền vào 
        if ($params != null) {
            $types = "";
            $values = array();

            foreach ($params as $field => $value) {
                if (is_float($value)) {
                    $types .= "d";
                } elseif (is_integer($value)) {
                    $types .= "i";
                } elseif (is_string($value)) {
                    $types .= "s";
                } else {
                    $types .= "b";
                }
                array_push($values, $value);
            }
            $command->bind_param($types, ...$values); // Gán giá trị tham số
        }
        // thực thi câu truy vấn
        if ($command->execute()) {
            return $command->affected_rows > 0;
        } else {
            print($command->error);
            return false;
        }
        $command->close();
        $con->close();
    }
}
