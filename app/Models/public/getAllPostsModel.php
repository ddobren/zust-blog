<?php

class GetAllPostsModel
{
    private static function hrDateFromUnix(int $ts): string
    {
        static $mjeseci = [
            1 => 'Siječnja',
            2 => 'Veljače',
            3 => 'Ožujka',
            4 => 'Travnja',
            5 => 'Svibnja',
            6 => 'Lipnja',
            7 => 'Srpnja',
            8 => 'Kolovoza',
            9 => 'Rujna',
            10 => 'Listopada',
            11 => 'Studenoga',
            12 => 'Prosinca'
        ];
        $d = getdate($ts);
        $day = $d['mday'];
        $monthName = $mjeseci[$d['mon']] ?? '';
        $year = $d['year'];
        return "{$day}. {$monthName} {$year}.";
    }

    public static function getSeparatedPost(): array
    {
        try {
            $db = Conn::get();

            $sql = "
                SELECT 
                    CASE 
                        WHEN c.name IS NULL THEN CONCAT('#', p.category_id)
                        ELSE c.name
                    END AS category_name,
                    p.title,
                    p.slug,
                    p.published_at,       -- UNIX timestamp
                    p.description,
                    p.thumbnail_path
                FROM posts p
                LEFT JOIN categories c ON c.id = p.category_id
                ORDER BY p.published_at DESC
                LIMIT 1
            ";
            $stmt = $db->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) return [];

            $row['published_at_hr'] = self::hrDateFromUnix((int)$row['published_at']);

            unset($row['published_at']);

            return $row;
        } catch (PDOException $e) {
            ErrorHandlerSys::add("Greška prilikom dohvaćanja izdvojenog posta: " . $e->getMessage());
            return [];
        }
    }
}
