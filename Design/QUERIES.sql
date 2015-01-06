#COMEPLETELY CHECKED
#############################
1. get movies 
1.1 film artist input
select jj.movie_name, jj.genre, gg.suggested_audience, jj.release_date, jj.duration, jj.language, jj.rating, jj.num_of_ratings, jj.num_of_reviews
from 
(select joined.movie_name movie_name, joined.genre genre, joined.release_date release_date, joined.duration duration, joined.language language, joined.rating rating, joined.num_of_ratings num_of_ratings, joined.num_of_reviews num_of_reviews from
(select a.mname movie_name, a.duration duration, a.language language, a.genre genre, a.release_date release_date, a.rating rating, a.num_of_ratings num_of_ratings, a.num_of_reviews num_of_reviews, b.art_fname fname, b.art_lname lname
from movie_artist_table i, movie_table a, artist_table b
where i.movie_id = a.movie_id and b.artist_id = i.artist_id) joined
where joined.fname = 'INPUT.fname' and joined.lname = 'INPUT.lname') jj, genre_table gg
where jj.genre = gg.genre_name;

1.2 INPUT genre
select mname, release_date, duration, language
from movie_table
where genre = 'INPUT.genre';

1.3INPUT award
select joined.movie_name, joined.duration, joined.language, joined.genre, joined.release_date, joined.category, joined.year, joined.fname, joined.lname, joined.rating, joined.num_of_ratings, joined.num_of_reviews
from (select a.mname movie_name, a.duration duration, a.language language, a.genre genre, a.release_date release_date , b.category category, b.year year, c.art_fname fname, c.art_lname lname, d.award_name award,  a.rating rating, a.num_of_ratings num_of_ratings, a.num_of_reviews num_of_reviews
from movie_table a, movie_artist_award_table b, artist_table c, award_table d 
where a.movie_id=b.movie_id and b.artist_id=c.artist_id and b.award_id=d.award_id) joined 
where joined.award='INPUT.award_name';

1.4INPUT language
select mname, release_date, duration, genre, rating, num_of_ratings, num_of_reviews
from movie_table
where language = 'INPUT.language';

1.5INPUT year
select mname, duration, genre, language, rating, num_of_ratings, num_of_reviews
from movie_table
where release_date = 'INPUT.year';
#COMEPLETELY CHECKED

#############################
2. GET ARTIST
2.1INPUT movie name
select artist_table.art_fname, artist_table.art_lname, artist_table.job_title, artist_table.age, artist_table.origin
from movie_artist_table
inner join artist_table
on artist_table.artist_id=movie_artist_table.artist_id
inner join movie_table
on movie_table.movie_id=movie_artist_table.movie_id
where movie_table.mname='INPUT.mname';

2.2 INPUT award name
select c.art_fname, c.art_lname, i.category, i.year, c.job_title, c.age, c.origin, a.mname, a.genre, a.language, a.release_date, a.duration, a.rating, a.num_of_ratings, a.num_of_reviews
from movie_artist_award_table i, movie_table a, award_table b, artist_table c
where i.movie_id=a.movie_id and i.award_id=b.award_id and i.artist_id=c.artist_id
and b.award_name='INPUT.award_name';

2.3.special: award and genre
select c.art_fname, c.art_lname, i.category, i.year, c.job_title, c.age, c.origin, a.mname, a.genre, a.language, a.release_date, a.duration, a.rating, a.num_of_ratings, a.num_of_reviews
from movie_artist_award_table i, movie_table a, award_table b, artist_table c
where i.movie_id=a.movie_id and i.award_id=b.award_id and i.artist_id=c.artist_id
and b.award_name='INPUT.award_name' and a.genre='INPUT.genre';

2.4INPUT job title
select art_fname, art_lname, age, origin from artist_table
where job_title=INPUT;

#############################
3.GET AWARD
3.1 input artist fname and lname
select b.award_name, i.category, i.year, b.organisation, b.description, a.mname, a.genre, a.rating
from movie_artist_award_table i, movie_table a, award_table b, artist_table c
where i.movie_id=a.movie_id and i.award_id=b.award_id and i.artist_id=c.artist_id
and c.art_fname = 'INPUT.fname' and c.art_lname = 'INPUT.lname';

3.2 award by movie
select b.award_name,i.category, i.year, b.organisation, b.description, c.art_fname, c.art_lname, c.job_title, c.age, c.origin
from movie_artist_award_table i, movie_table a, award_table b, artist_table c
where i.movie_id=a.movie_id and i.award_id=b.award_id and i.artist_id=c.artist_id
and a.mname = 'INPUT.movie_name';

#############################
4. get TOP MOVIES
4.1top 3 by genre
select * from 
(select mname, duration, language, release_date, rating, num_of_ratings, num_of_reviews
from movie_table
where genre='INPUT.genre'
order by rating desc) a
limit 3;

4.2top 3 by film actor
select * from
(select * from 
(select movie_table.mname, movie_table.duration, movie_table.language, movie_table.release_date, movie_table.genre, movie_table.rating rating
from movie_artist_table, artist_table, movie_table
where artist_table.artist_id=movie_artist_table.artist_id and movie_table.movie_id=movie_artist_table.movie_id
and artist_table.art_fname='INPUT.fname' and artist_table.art_lname='INPUT.lname') joined
order by joined.rating desc) b
limit 3;

4.3 top 3
select * from
(select mname, duration, genre, language, release_date, rating
from movie_table
order by rating desc) a
limit 3;

################################################################
NOT CHECKED - ***NOT SUPPORTED BY MYSQL*** THIS IS ORACLE QUERY
5.PREQUEL SEQUEL PART
SELECT lpad(movie_name,length(movie_name) + LEVEL * 10 - 10,'-') 
FROM 
(select movie_table.movie_id as movie_id, movie_table.mname as movie_name, sequence_table.sequel as sequel
from movie_table, sequence_table
where movie_table.movie_id=sequence_table.movie_id)
START WITH movie_id = INPUT 
CONNECT BY PRIOR movie_id = sequel);


################################################################
6.number of movies contributed each a film artist
select aa.art_fname, aa.art_lname, jj.num_of_movies, aa.job_title, aa.origin, aa.age
from (select i.artist_id, count(*) num_of_movies
from movie_artist_table i, artist_table a
where i.artist_id = a.artist_id
group by artist_id) jj, artist_table aa
where jj.artist_id=aa.artist_id;

################################################################
################################################################
################################################################
Simple Queries needed PHP for User pages
777. ADD TO watchlist
$MOVIE_ID = select movie_id from movie_table
where mname = 'INPUT.movie_name'

insert into watchlist VALUES($USERNAME, $MOVIE_ID)

777. WRITE REVIEW
$MOVIE_ID = select movie_id from movie_table
where mname = 'INPUT.movie_name'

insert into review_table VALUES('$USERNAME', '$MOVIE_ID', '$REVIEW')

777. RATE MOVIE
$MOVIE_ID = select movie_id from movie_table
where mname = 'INPUT.movie_name'

CALL RATING_INSERT('$USERNAME', '$MOVIE_ID', '$RATING')

################################################################
DONE: 
################################################################
################################################################
################################################################
####Procedures


DELIMITER $$
 
CREATE PROCEDURE `RATING_INSERT` (IN u_name varchar(25), IN m_id INT, IN rat FLOAT)
BEGIN

	DECLARE nos_r INT DEFAULT 0;
	DECLARE num_rat INT DEFAULT 0;
	DECLARE new_rat INT DEFAULT 0;
	DECLARE tot_rat INT DEFAULT 0;
	
	select num_of_ratings into nos_r from movie_db.movie_table 
	where movie_id=m_id;
	
	insert into movie_db.rating_table (user_name, movie_id, rating) values (u_name, m_id, rat);
	-- if above query fails it exits here
	
	update movie_db.movie_table
	set num_of_ratings=nos_r + 1
	where movie_id=m_id;
	
	select sum(rating) into tot_rat from movie_db.rating_table
	group by movie_id
	having movie_id=m_id;
	
	select num_of_ratings into num_rat from movie_db.movie_table
	where movie_id=m_id;
	
	-- set new_rat = ((old_rat * nos_r) + rat)/(nos_r + 1);
	
	-- set new_rat = tot_rat / num_rat;
	
	update movie_db.movie_table
	set rating = tot_rat / num_rat
	where movie_id=m_id;
 
END$$

DELIMITER ;

#########################################################################################################################################################################TRIGGER
TRIGGER

CREATE DEFINER = CURRENT_USER TRIGGER `movie_db`.`review_table_AFTER_INSERT` AFTER INSERT ON `review_table` FOR EACH ROW
begin
	update movie_db.movie_table
	set num_of_reviews = num_of_reviews + 1
    where movie_id = NEW.movie_id;
end