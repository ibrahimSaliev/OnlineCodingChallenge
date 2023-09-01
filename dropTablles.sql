drop table part_eval_course;
drop table course;
drop table eval;
drop table challenge_has_tags;
drop table tags;
drop table award_participator;
drop table award;
drop table solution_comments;
drop table challenge_comments;
drop table contest cascade constraints;
drop table solved_challenges;
drop table solution cascade constraints;
drop table challenge cascade constraints;
drop table participator cascade constraints;
drop table poster cascade constraints;
drop table person cascade constraints;


drop sequence poster_posted_ch_seq;
drop sequence particip_nr_solved_challenges_seq;
drop sequence particip_points_seq;
drop sequence particip_nr_of_awards_seq;
drop sequence solution_id_seq;


drop trigger SOLUTION_ID_SEQUENCE_TRIGGER;
drop trigger afterSolutionProvided;
drop trigger challengeInsertTrigger;

drop procedure close_to_award;


drop view Most_Posted_Challenges_Country;
drop view Won_Contest_AtLeast3Times;