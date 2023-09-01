CREATE TABLE person(

username varchar(30) not null,
age integer,
gender varchar(10) default 'Unknown',
nr_of_reviews integer,
country varchar(40),
CONSTRAINT pk_person PRIMARY KEY(username),
check (gender in ('M', 'F', 'Unknown')),
check (age < 100 and age > 6),
check (length(username) > 2)
);


CREATE TABLE poster(

username varchar(30) not null,
nr_posted_challenges integer default 0,
CONSTRAINT pk_poster PRIMARY KEY(username),
CONSTRAINT fk_poster
    FOREIGN KEY(username) REFERENCES person(username) 
    ON DELETE CASCADE
);


CREATE TABLE participator(

username varchar(30) not null,
points integer default 0,
nr_of_awards integer default 0,
nr_solved_challenges integer default 0,
CONSTRAINT pk_particip PRIMARY KEY(username),
CONSTRAINT fk_particip
    FOREIGN KEY(username) REFERENCES person(username) 
    ON DELETE CASCADE
);


CREATE TABLE challenge(

challenge_id integer GENERATED ALWAYS AS IDENTITY,
title varchar(50) not null,
difficulty CHAR(1) default 'M',
descript varchar(1000),
points integer,
posted_by varchar(30),
CONSTRAINT pk_challenge PRIMARY KEY(challenge_id),
CONSTRAINT fk_challenge
    FOREIGN KEY(posted_by) REFERENCES poster(username) 
    ON DELETE CASCADE,
check(difficulty in ('E','M','H'))    
);


CREATE TABLE solution(
solution_id integer not null,
challenge_id integer not null,
date_of_solution date default CURRENT_DATE,
descript varchar(1000),
provided_by varchar(30) not null, 
CONSTRAINT pk_solution PRIMARY KEY(solution_id,challenge_id),
CONSTRAINT solution_unique UNIQUE (challenge_id,provided_by),
CONSTRAINT fk_solution_pa
    FOREIGN KEY(provided_by) REFERENCES participator(username) 
    ON DELETE CASCADE,
CONSTRAINT fk_solution_ch
    FOREIGN KEY(challenge_id) REFERENCES challenge(challenge_id) 
    ON DELETE CASCADE  
);


CREATE TABLE solved_challenges(
challenge_id integer not null,
username varchar(30) not null,
CONSTRAINT pk_solved_ch PRIMARY KEY(challenge_id,username),
CONSTRAINT fk_solved_ch_id
    FOREIGN KEY(challenge_id) REFERENCES challenge(challenge_id) 
    ON DELETE CASCADE,
CONSTRAINT fk_solved_ch_username
    FOREIGN KEY(username) REFERENCES participator(username) 
    ON DELETE CASCADE 
);


CREATE TABLE contest(

contest_id integer GENERATED ALWAYS AS IDENTITY,
challenge_id integer not null,
winner varchar(30),
nr_contestants integer,
start_time timestamp default current_timestamp,
end_time timestamp,
first_player varchar(30),
second_player varchar(30),
third_player varchar(30),
fourth_player varchar(30),
CONSTRAINT pk_contest PRIMARY KEY(contest_id),
CONSTRAINT fk_contest1
    FOREIGN KEY(first_player) REFERENCES participator(username) 
    ON DELETE CASCADE,
CONSTRAINT fk_contest2
    FOREIGN KEY(second_player) REFERENCES participator(username) 
    ON DELETE CASCADE,
CONSTRAINT fk_contest3
    FOREIGN KEY(third_player) REFERENCES participator(username) 
    ON DELETE CASCADE,
CONSTRAINT fk_contest4
    FOREIGN KEY(fourth_player) REFERENCES participator(username) 
    ON DELETE CASCADE,
CONSTRAINT fk_contestw
    FOREIGN KEY(winner) REFERENCES participator(username) 
    ON DELETE CASCADE,    
check(nr_contestants <=4 and nr_contestants >0)    
);


CREATE TABLE challenge_comments(

comment_id integer GENERATED ALWAYS AS IDENTITY,
challenge_id integer not null,
username VARCHAR(30) not null,
comment_text VARCHAR(1000),
CONSTRAINT pk_comment_ch PRIMARY KEY(comment_id),
CONSTRAINT fk_comment_ch_id
    FOREIGN KEY(challenge_id) REFERENCES challenge(challenge_id) 
    ON DELETE CASCADE,
CONSTRAINT fk_comment_ch_username
    FOREIGN KEY(username) REFERENCES person(username) 
    ON DELETE CASCADE
);


CREATE TABLE solution_comments(

comment_id integer GENERATED ALWAYS AS IDENTITY,
solution_id integer not null,
challenge_id integer not null,
username VARCHAR(30) not null,
comment_text VARCHAR(1000),
CONSTRAINT pk_comment_so PRIMARY KEY(comment_id),
CONSTRAINT fk_comment_so_id
    FOREIGN KEY(solution_id, challenge_id) REFERENCES solution(solution_id,challenge_id) 
    ON DELETE CASCADE,
CONSTRAINT fk_comment_so_username
    FOREIGN KEY(username) REFERENCES person(username) 
    ON DELETE CASCADE
);


CREATE TABLE award(

award_name VARCHAR(20) not null,
award_desc VARCHAR(50),
required_points integer,
required_solved_challenges integer,
CONSTRAINT pk_award PRIMARY KEY(award_name)
);


CREATE TABLE award_participator(

award_name VARCHAR(20) not null,
username VARCHAR(30) not null,
CONSTRAINT pk_award_part PRIMARY KEY(award_name,username),
CONSTRAINT fk_award_part_name
    FOREIGN KEY(award_name) REFERENCES award(award_name) 
    ON DELETE CASCADE,
CONSTRAINT fk_award_part_username
    FOREIGN KEY(username) REFERENCES participator(username) 
    ON DELETE CASCADE
);


CREATE TABLE tags(
tag_id integer GENERATED ALWAYS AS IDENTITY,
tag_name varchar(30),
CONSTRAINT pk_tag PRIMARY KEY(tag_id)
);


CREATE TABLE challenge_has_tags(

tag_id integer not null,
challenge_id integer not null,
CONSTRAINT pk_ch_tag PRIMARY KEY(tag_id,challenge_id),
CONSTRAINT fk_ch_tag
    FOREIGN KEY(tag_id) REFERENCES tags(tag_id) 
    ON DELETE CASCADE,
CONSTRAINT fk_ch_ch_id
    FOREIGN KEY(challenge_id) REFERENCES challenge(challenge_id) 
    ON DELETE CASCADE
);


CREATE TABLE eval(
rating number not null,
percentage number,
evaluated_by varchar(40),
CONSTRAINT pk_eval PRIMARY KEY(rating)
);


CREATE TABLE course(
course_name varchar(40) not null,
price number default 0.00,
issued_by varchar(40),
course_hours number,
CONSTRAINT pk_course PRIMARY KEY(course_name)
);


CREATE TABLE part_eval_course(

rating number,
username varchar(30) not null,
course_name varchar(40) not null,
CONSTRAINT pk_part_eval_course PRIMARY KEY(username,course_name),
CONSTRAINT fk_part_eval_course_rating
    FOREIGN KEY(rating) REFERENCES eval(rating) 
    ON DELETE CASCADE,
CONSTRAINT fk_part_eval_course_username
    FOREIGN KEY(username) REFERENCES participator(username) 
    ON DELETE CASCADE,
CONSTRAINT fk_part_eval_course_course
    FOREIGN KEY(course_name) REFERENCES course(course_name) 
    ON DELETE CASCADE    
);


--sequences        
       
create sequence solution_id_seq;
create sequence particip_nr_solved_challenges_seq;
create sequence poster_posted_ch_seq;
create sequence particip_points_seq;
create sequence particip_nr_of_awards_seq;


--triggers              

/* triggered after insert is made on Challenge table. It increases the number of posted challenges by 1
of the poster who posted it */ 
create trigger challengeInsertTrigger after insert on challenge
for each row
begin
update poster set nr_posted_challenges=(select nr_posted_challenges from poster where username=:new.posted_by) + 1 
where username=:new.posted_by;
end;
/

/* triggered after insert on Solution. 3 actions are triggered: 1: number of solved challenges of the participator who provided
the solution is increased by one. 2: points of the participator are updated --> points from the challenge are added to the 
existing points of the participator. 3: solved_challenges table is populated by the solved challenge id and the participaror
username.*/
create trigger afterSolutionProvided after insert on solution
for each row
begin
update participator set nr_solved_challenges=(select nr_solved_challenges from participator where username=:new.provided_by) + 1
 where username=:new.provided_by;
update participator set points=(select points from challenge where challenge_id=:new.challenge_id) + 
(select points from participator where username=:new.provided_by) where username = :new.provided_by;
insert into solved_challenges (challenge_id, username) values (:new.challenge_id, :new.provided_by);
end;
/

CREATE OR REPLACE TRIGGER SOLUTION_ID_SEQUENCE_TRIGGER
BEFORE INSERT ON solution
FOR EACH ROW
BEGIN
	IF :new.solution_id IS NULL THEN
		SELECT solution_id_seq.nextval INTO :new.solution_id FROM DUAL;
	END IF;
END;
/


--Stored Procedure                      

/* a procedure that will show you how many participators are close to winning a certain award. The parameters are : 
aw_name: the name of the award , total_points: the range in which we want to check ( e.g. if we set points to equal 5,
then we will get the number of participators that are 1-5 points away from winning the award AND res: the 
actual number of participators close to the award.*/
CREATE OR REPLACE PROCEDURE close_to_award (aw_name IN VARCHAR, total_points IN integer, res OUT integer) 
IS
     award_total_points integer;
BEGIN
      select a.required_points into award_total_points from award a where a.award_name = aw_name;
      select count(*) into res from participator p where p.points >= 
      (award_total_points - total_points) and p.points 
      < award_total_points;
END;
/


--Views          

/*  poster that posted most challenges per country -> display the number of those posted challenges  */
create view Most_Posted_Challenges_Country as
select u.country, max(p.nr_posted_challenges) as MostPostedPerCountry  from person u join
poster p on u.username = p.username group by u.country;



/* players that won the contest at least 3 times */
create view Won_Contest_AtLeast3Times as
select c.winner , count(c.contest_id) as Number_Of_Times_Won from contest c
group by c.winner having count(c.contest_id) >= 3;
