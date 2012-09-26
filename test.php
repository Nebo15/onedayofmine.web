

function testAuth_Parameters()
{
  assertDispatchedWithParams("/auth/parameters", []);
}

function testAuth_IsLoggedIn()
{
  assertDispatchedWithParams("/auth/is_logged_in", []);
}

function testAuth_Login()
{
  assertDispatchedWithParams("/auth/login", []);
}

function testAuth_Logout()
{
  assertDispatchedWithParams("/auth/logout", []);
}

function testDays_Interesting()
{
  assertDispatchedWithParams("/days/interesting", []);
}

function testDays_New()
{
  assertDispatchedWithParams("/days/new", []);
}

function testDays_Search()
{
  assertDispatchedWithParams("/days/search", []);
}

function testDays_Following()
{
  assertDispatchedWithParams("/days/following", []);
}

function testDays_My()
{
  assertDispatchedWithParams("/days/my", []);
}

function testDays_Favourite()
{
  assertDispatchedWithParams("/days/favourite", []);
}

function testDays_ById()
{
  assertDispatchedWithParams("/days/1922", []);
}

function testDays_Current()
{
  assertDispatchedWithParams("/days/current", []);
}

function testDays_ByIdComment()
{
  assertDispatchedWithParams("/days/1926/comment", []);
}

function testDays_ByIdComments()
{
  assertDispatchedWithParams("/days/1926/comments", []);
}

function testDays_ByIdShare()
{
  assertDispatchedWithParams("/days/1927/share", []);
}

function testDays_ByIdLike()
{
  assertDispatchedWithParams("/days/1928/like", []);
}

function testDays_ByIdUnlike()
{
  assertDispatchedWithParams("/days/1928/unlike", []);
}

function testDays_Start()
{
  assertDispatchedWithParams("/days/start", []);
}

function testDays_ByIdAddMoment()
{
  assertDispatchedWithParams("/days/1942/add_moment", []);
}

function testDays_ByIdFinish()
{
  assertDispatchedWithParams("/days/1942/finish", []);
}

function testDays_ByIdUpdate()
{
  assertDispatchedWithParams("/days/1929/update", []);
}

function testDays_ByIdDelete()
{
  assertDispatchedWithParams("/days/1930/delete", []);
}

function testDays_ByIdRestore()
{
  assertDispatchedWithParams("/days/1932/restore", []);
}

function testDays_ByIdMarkCurrent()
{
  assertDispatchedWithParams("/days/1932/mark_current", []);
}

function testDays_ByIdMarkFavourite()
{
  assertDispatchedWithParams("/days/1939/mark_favourite", []);
}

function testDays_ByIdUnmarkFavourite()
{
  assertDispatchedWithParams("/days/1940/unmark_favourite", []);
}

function testDays_ByIdComplain()
{
  assertDispatchedWithParams("/days/1960/complain", []);
}

function testDays_Types()
{
  assertDispatchedWithParams("/days/types", []);
}

function testMoments_ByIdLike()
{
  assertDispatchedWithParams("/moments/600/like", []);
}

function testMoments_ByIdUnlike()
{
  assertDispatchedWithParams("/moments/600/unlike", []);
}

function testMoments_ByIdComment()
{
  assertDispatchedWithParams("/moments/600/comment", []);
}

function testMoments_ByIdComments()
{
  assertDispatchedWithParams("/moments/1926/comments", []);
}

function testMoments_ByIdUpdate()
{
  assertDispatchedWithParams("/moments/598/update", []);
}

function testMoments_ByIdDelete()
{
  assertDispatchedWithParams("/moments/599/delete", []);
}

function testDayComments_ByIdDelete()
{
  assertDispatchedWithParams("/day_comments/169/delete", []);
}

function testMomentComments_ByIdDelete()
{
  assertDispatchedWithParams("/moment_comments/170/delete", []);
}

function testMy_Profile()
{
  assertDispatchedWithParams("/my/profile", []);
}

function testMy_Settings()
{
  assertDispatchedWithParams("/my/settings", []);
}

function testMy_News()
{
  assertDispatchedWithParams("/my/news", []);
}

function testUsers_Search()
{
  assertDispatchedWithParams("/users/search", []);
}

function testUsers_ById()
{
  assertDispatchedWithParams("/users/4162", []);
}

function testUsers_ByIdDays()
{
  assertDispatchedWithParams("/users/4160/days/", []);
}

function testUsers_ByIdFollowers()
{
  assertDispatchedWithParams("/users/4168/followers", []);
}

function testUsers_ByIdFollowing()
{
  assertDispatchedWithParams("/users/4168/following", []);
}

function testUsers_ByIdFollow()
{
  assertDispatchedWithParams("/users/4175/follow", []);
}

function testUsers_ByIdUnfollow()
{
  assertDispatchedWithParams("/users/4177/unfollow", []);
}

function testUsers_ByIdActivity()
{
  assertDispatchedWithParams("/users/4177/activity", []);
}

function testSocial_FacebookFriends()
{
  assertDispatchedWithParams("/social/facebook/friends", []);
}

function testSocial_FacebookInvite()
{
  assertDispatchedWithParams("/social/facebook/invite", []);
}

function testSocial_TwitterConnect()
{
  assertDispatchedWithParams("/social/twitter/connect", []);
}

function testSocial_EmailInvite()
{
  assertDispatchedWithParams("/social/email/invite", []);
}
