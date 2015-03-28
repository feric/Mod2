//Autor: Esau Reyes Valdespino

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using TweetSharp;

namespace webSegura
{
    public partial class Form2 : Form
    {
        
        public Form2()
        {
            InitializeComponent();
        }

        private void Form2_Load(object sender, EventArgs e)
        {            
            
            TwitterService service = new TwitterService("CyF53YntotaWYggs5cmk3rHHv", "DtQAwLu6WH17YlyInuHUwjUtwbWqzZaNzffiKz7Lkq7k2APGgq");
            OAuthRequestToken requestToken = service.GetRequestToken();
            Uri uri = service.GetAuthorizationUri(requestToken);
            webBrowser1.Navigate(uri);
            string verifier = "12345";
            OAuthAccessToken access = service.GetAccessToken(requestToken,verifier);            
            service.AuthenticateWith(access.Token,access.TokenSecret);
                       
        }

        private void webBrowser1_DocumentCompleted(object sender, WebBrowserDocumentCompletedEventArgs e)
        {
        }

    }

    


}
