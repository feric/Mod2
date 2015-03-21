#!/usr/bin/perl -w
use strict;
use LWP::UserAgent;
print "Content-type:text/html\r\n\r\n";
my $ua = LWP::UserAgent->new;
#my $server_endpoint = "http://www.google.com/";
my $server_endpoint = "http://jsonplaceholder.typicode.com/posts";
# set custom HTTP request header fields
my $req = HTTP::Request->new(GET => $server_endpoint);
$req->header('content-type' => 'text/html');
#$req->header('content-type' => 'application/json');
#$req->header('x-auth-token' => 'kfksj48sdfj4jd9d');
my $resp = $ua->request($req);
if ($resp->is_success) {
    my $message = $resp->decoded_content;
    #print "Received reply: $message\n";
    print "<h1>$message</h1>";
}
else {
    print "HTTP GET error code: ", $resp->code, "\n";
    print "HTTP GET error message: ", $resp->message, "\n";
}
