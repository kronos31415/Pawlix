<?php
    class VideoProvider {
        public static function getUpNext($conn, $currentVideo) {
            $query = $conn->prepare("SELECT * FROM videos WHERE id != :videoId AND entityId = :entityId
                                    AND (
                                        ((season = :season AND episode > :episode) OR season > :season)
                                    ) ORDER BY season, episode ASC LIMIT 1");

            $query->bindValue(':videoId', $currentVideo->getId());
            $query->bindValue(':entityId', $currentVideo->getEntityId());
            $query->bindValue(':season', $currentVideo->getSeasonNumber());
            $query->bindValue(':episode', $currentVideo->getEpisodeNumber());

            $query->execute();

            if($query->rowCount() == 0) {
                $query = $conn->prepare("SELECT * FROM videos WHERE season <= 1 AND episode <=1 AND id != :videoID
                                        ORDER BY views DESC LIMIT 1");

                $query->bindValue(':videoID', $currentVideo->getId());
                $query->execute();

            }

            $row = $query->fetch(PDO::FETCH_ASSOC);
            return new Video($conn, $row);

        }
    }
?>