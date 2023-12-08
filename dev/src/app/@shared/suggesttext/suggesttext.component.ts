import { Component, OnInit, Inject, ViewEncapsulation, Input, Output, EventEmitter } from '@angular/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { FormGroup} from '@angular/forms';

export interface SuggestData {
  datatype: any;
  shortContent:any;
  defaulttemplate:any;
}

@Component({
  selector: 'app-suggesttext',
  templateUrl: './suggesttext.component.html',
  styleUrls: ['./suggesttext.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class SuggesttextComponent implements OnInit {
  @Input() dataSetName: FormGroup;
  @Input('dataType') suggestType: any;
  @Input('shortContent') shortContent:any = 'Default Template for Short Description';
  @Input('defaulttemplate') defaulttemplate:any;
  constructor(public suggestion: MatDialog) { }
  ngOnInit() {
  }
  openSuggestion(): void {
    const suggestionRef = this.suggestion.open(SuggesttemplateComponent, {
      width: '80vw',
      height: '80vh',
      panelClass: 'suggestion_panel',
      //backdropClass: 'suggestion_backdrop',
      // hasBackdrop: false,
      disableClose: true,
      data: { datatype: this.suggestType, shortContent:this.shortContent,defaulttemplate:this.defaulttemplate},
    });

    suggestionRef.afterClosed().subscribe(result => {
      this.dataSetName.setValue(result.suggestText)
    });
  }

}

@Component({
  selector: 'app-suggesttemplate',
  templateUrl: './suggesttemplate.component.html',
  styleUrls: ['./suggesttext.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class SuggesttemplateComponent implements OnInit {
  public dataType: any;
  public shortContent: any;
  public defaulttemplate:any;
  //public suggestArray: any;
  constructor(
    public dialogRef: MatDialogRef<SuggesttemplateComponent>,
    @Inject(MAT_DIALOG_DATA) public data: SuggestData) {
    if (data) {
      this.dataType = data.datatype;
      this.shortContent = data.shortContent;
      this.defaulttemplate = data.defaulttemplate;
    }
  }
  public suggestArray = [];
  public addData = [];
  public previewHeading = '';
  public previewText = '';
  onNoClick(): void {
    this.dialogRef.close();
    this.previewHeading = '';
    this.previewText = '';
  }
  ngOnInit() {
     /* this.suggestArray = [
      {
        suggestTitle: 'About Company Template 1',
        suggestText: "Based in the Sultanate of Oman, businessgateways is an IT organisation implementing nationwide technology-driven projects that positively impact the growth of the community. businessgateways provides advanced technology solutions to its stakeholders, with disruptive ideas contributing to successful complex applications using a Build and Operate model. Our various online platforms enable organizations, people and governments to reach their goals with our improved business agility by building on innovation, technology and sustainability - connecting the world of business in a way that is unique and exciting.<br>Our core focus is in Building and Operating National Platforms online. Tasked with developing and implementing some of the truly complex and intricate National IT projects in the region by our various Government Stakeholders, we constantly challenge our delivery models by listening to the business community, understanding the needs of the buyers, suppliers and citizens alike and raising our own delivery benchmarks to meet these expectations. We listen to their needs and explore professional service mechanisms that can be delivered to your doorstep through technology.",
      },
      {
        suggestTitle: 'About Company Template 2',
        suggestText: "Apple is an American technology company founded by Steve Jobs, Steve Wozniak, and Ronald Wayne in April 1976. Incorporated in 1977, the company was one of the early manufacturers of personal computing devices with graphical user interfaces. Over the years, the company also forayed into other consumer electronics segments like mobile communication devices, digital music players, notebooks, and wearable. The company also develops and markets a range of related software and services, accessories, and networking solutions. Currently, the company’s chief executive officer (CEO) is Timothy Donald Cook, commonly known as Tim Cook.<br> From smart wearable to digital content streaming platforms, Apple offers a wide range of products and services within a closed ecosystem. Its products include iMac desktops, MacBook notebooks, iPhone mobile devices, iPad tablets, iPod digital multimedia devices, Apple Watch and Apple TV. The services include an iOS operating system for mobile devices, macOS operating system for notebooks and desktops, iCloud online storage, tvOS operating system for Apple TV, watchOS operating system for Apple Watch, iTunes for digital content services, Apple Pay digital payment service, Apple Music for online multimedia streaming, and Apple News.",
      },
      {
        suggestTitle: 'About Company Template 3',
        suggestText: "Amazon is guided by four principles: customer obsession rather than competitor focus, passion for invention, commitment to operational excellence, and long-term thinking. Amazon strives to be Earth’s Most Customer-Centric Company, Earth’s Best Employer, and Earth’s Safest Place to Work. Customer reviews, 1-Click shopping, personalized recommendations, Prime, Fulfillment by Amazon, AWS, Kindle Direct Publishing, Kindle, Career Choice, Fire tablets, Fire TV, Amazon Echo, Alexa, Just Walk Out technology, Amazon Studios, and The Climate Pledge are some of the things pioneered by Amazon.",
      }, 
      {
        suggestTitle: 'About Company Template 4',
        suggestText: "Google, in full Google LLC formerly Google Inc. (1998–2017), American search engine company, founded in 1998 by Sergey Brin and Larry Page, that is a subsidiary of the holding company Alphabet Inc. More than 70 percent of worldwide online search requests are handled by Google, placing it at the heart of most Internet users’ experience. Its headquarters are in Mountain View, California.<br>Google began as an online search firm, but it now offers more than 50 Internet services and products, from e-mail and online document creation to software for mobile phones and tablet computers. In addition, its 2012 acquisition of Motorola Mobility put it in the position to sell hardware in the form of mobile phones. Google’s broad product portfolio and size make it one of the top four influential companies in the high-tech marketplace, along with Apple, IBM, and Microsoft. Despite this myriad of products, its original search tool remains the core of its success. In 2016 Alphabet earned nearly all of its revenue from Google advertising based on users’ search requests.",
      },
      {
        suggestTitle: 'About Company Template 5',
        suggestText: "PayPal, American e-commerce company formed in March 2000 that specializes in Internet money transfers. It was heavily used by the Internet auction company eBay, which owned PayPal from 2002 to 2015. Paypal was the product of a merger between X.com and Confinity, and it allowed users to make payments on purchased goods or exchange money between accounts in a secure online transaction.<br>After watching PayPal become the premier choice of Internet auction shoppers, online marketplace giant eBay acquired PayPal for $1.5 billion in October 2002. The company offers users the ability to link their PayPal accounts to their own bank accounts, making transfers and payments more efficient than money orders or checks. Fees are collected by eBay on certain transactions and are determined based on the amount of the transaction, the nature of the transaction, and the currency type of the transaction. In 2015 PayPal was spun off into an independent company, but it continued to be used by eBay.<br>A sophisticated series of security advancements helped PayPal remain a respected company in terms of identity theft prevention. The company implemented superior anti-phishing and anti-hacking measures, and it developed a portable “key” device that requires manual activation before a transfer from a PayPal account is processed. PayPal allows consumers to contest and request a refund in transactions where they have been misled or cheated. Additionally, PayPal offers a type of limited protection for sellers and includes a system that deactivates accounts when suspicious or excessive activity is observed.",
      },
      {
        suggestTitle: 'About Company Template 6',
        suggestText: "Flipkart Private Limited is an Indian e-commerce company established in 2007. It started with a primary focus on online book sales and soon, expanded to lifestyle products, electronics, home essentials and groceries. Today, Flipkart is the biggest online Indian marketplace competing with the world leader Amazon.<br>Since 2010, the company has made a number of acquisitions including Letsbuy, Myntra, Jabong, eBay India, etc. In addition to its main office in Bengaluru, Flipkart has branch offices at Delhi and Mumbai. Apart from India, the firm is registered in Singapore. In 2018, the US-based retail chain Walmart acquired majority stake in Flipkart.<br>Recently, Flipkart has opened its R&D centre at Israel. This is in line with its latest acquisition of Israeli start-up Upstream Commerce. The centre is run by talented engineers from across the world.",
      },
      {
        suggestTitle: 'About Company Template 7',
        suggestText: "IBM has been present in India since 1951. Since inception, IBM India has expanded its operations with regional headquarters in Bangalore and offices across 20 cities. IBM India has established itself as one of the leaders in the Indian Information Technology Industry.<br>As a leading cognitive solutions and cloud platform company, innovation is at the core of the IBM company strategy. This is reflected in the end-to-end solutions delivered to clients, which span from software and systems hardware to a broad range of infrastructure, cognitive, cloud and consulting services.IBM helps clients solve complex business and technical issues by delivering deep business process and industry expertise. This is enhanced with advanced analytics, research capabilities, comprehensive IT infrastructure knowledge and the proven ability to implement enterprise solutions to deliver bottom line value to businesses and governments worldwide."
      },
      {
        suggestTitle: 'About Company Template 8',
        suggestText: "With 2020 sales and revenues of $41.7 billion, Caterpillar Inc. is the world’s leading manufacturer of construction and mining equipment, diesel and natural gas engines, industrial gas turbines, and diesel-electric locomotives.<br>Since 1925, we’ve been driving sustainable progress and helping customers build a better world through innovative products and services. Throughout the product life cycle, we offer services built on cutting-edge technology and decades of product expertise. These products and services, backed by our global dealer network, provide exceptional value to help our customers succeed.<br>We do business on every continent, principally operating through three primary segments – Construction Industries, Resource Industries, and Energy & Transportation – and providing financing and related services through our Financial Products segment.<br>Caterpillar is the world’s leading manufacturer of construction and mining equipment, diesel and natural gas engines, industrial gas turbines and diesel-electric locomotives. We are a leader and proudly have the largest global presence in the industries we serve. Learn more about our Strategy, Governance, History and Brands, as well as the values that guide our conduct.<br>Our customers rely on Caterpillar products to advance sustainable progress and improve living standards. This commitment to better extends to our own organization where we strive to be a model for environmental stewardship and social responsibility."
      },
      {
        suggestTitle: 'About Company Template 9',
        suggestText: "The era was the 1950’s. Brass was still the wonder metal. The late Shri. V. Murugesa Chettiar envisioned Stainless Steel to become the next wonder. Thus was born a brand called ‘Butterfly’.<br>The first product was the modest stainless steel tumbler. The Butterfly touch of perfection & quality even in the simple tumbler made it stand out. The reception we had for it made us expand our product line into various other utensils. It was not long before we mixed this perfection & our technical know how to create India’s first stainless steel pressure cooker.<br>Today by building exquisite kitchen appliances ranging from LPG stoves, Mixer Grinders, Table Top Wet grinders to Blenders & Sandwich makers with cutting edge technology, we have planted ourselves as a pioneer & market leader in Kitchen appliances. With many firsts like, the first in India to introduce stainless steel pressure cookers, LPG stoves & Vacuum Flasks, we have also ensured that we will never leave you shorthanded in the kitchen.<br>This endeavor has not stopped at just winning the hearts of the lakhs of Butterfly consumers. Indian Standards Organization (ISI) raised the bench mark thermal efficiency of LPG stoves from 64% to 68% after we successfully demonstrated that we can provide that level of quality. We were also the first kitchen appliances brand in India to receive the ISO-9001 for manufacture & supply of LPG Stoves, mixer grinders & Table-top wet grinders."
      },
      {
        suggestTitle: 'About Company Template 10',
        suggestText: "Alibaba Launched in 1999, Alibaba.com is the leading platform for global wholesale trade. We serve millions of buyers and suppliers around the world.<br>Alibaba.com brings you hundreds of millions of products in over 40 different major categories, including consumer electronics, machinery and apparel.<br>Buyers for these products are located in 190+ countries and regions, and exchange hundreds of thousands of messages with suppliers on the platform each day.<br>As a platform, we continue to develop services to help businesses do more and discover new opportunities.<br>Whether it’s sourcing from your mobile phone or contacting suppliers in their local language, turn to Alibaba.com for all your global business needs."
      },
      {
        suggestTitle: 'About Company Template 11',
        suggestText: "YouTube is an online video sharing and social media platform owned by Google. Around the world, its users watch more than one billion hours of YouTube videos each day.YouTube creators, popularly referred to as YouTubers, upload over one hundred hours of content per minute. In 2005, YouTube.com was launched by Steve Chen, Chad Hurley, and Jawed Karim.<br>Over the years, YouTube has expanded beyond the website into mobile apps, network television, and to permit other services like Discord and Nintendo to access YouTube. The range of videos on YouTube is seemingly infinite; users can find music videos, video clips, short and documentary films, audio recordings, corporate-sponsored movie trailers, live streams, video blogs, as well as content from popular YouTubers. Most content today is still generated by individuals, including collaborations between YouTubers and companies that sponsor YouTubers. Over the past six years, established media corporations such as Disney, ViacomCBS, and WarnerMedia have created and expanded their corporate YouTube channels to promote their content to a larger audience. YouTube also acts as a social network by allowing users with a Google account to watch and upload their own videos, comment on videos, rate and respond to comments, like or dislike videos, create playlists, and subscribe to other users and channels.<br>In 2006, when YouTube was a year old, it was bought by Google for US$1.65 billion. Under Google from 2006 onwards, YouTube evolved from a small video streaming platform to an international juggernaut influencing popular culture, internet trends, and creating multimillionaire celebrities. YouTube as a company has reported revenues of $19.8 billion in 2020. Globally, after Google.com, YouTube is the most visited website, with over one billion monthly users. Google's ownership of YouTube has also changed its business model; it no longer generates revenue from advertisements alone. YouTube now offers paid content such as movies and exclusive content. YouTube itself and approved creators participate in Google's AdSense program, which generates more revenue for both parties.<br> YouTube's expansion also led it to become one of the landmarks of the modern internet and an integral part of daily life for many users. With billions of hours of content and thousands of niche groups, YouTube has also had a great social impact. As YouTube has grown and evolved, it has become involved in many controversies that have made headline news. Such issues include: YouTube's self-censorship, alleged corporate favoritism, users spreading conspiracy theories, and issues regarding child safety and wellbeing."
      },
      {
        suggestTitle: 'MISSION Template 1',
        suggestText: "Enhance Opportunities, Expand Reach and Excel Performance of our corporate members by integrating human excellence, technology and business governance." },
      {
        suggestTitle: 'MISSION Template 2',
        suggestText: "To inspire humanity — both in the air and on the ground." },
      {
        suggestTitle: 'MISSION Template 3',
        suggestText: "To accelerate the world's transition to sustainable energy." },
      {
        suggestTitle: 'MISSION Template 4',
        suggestText: "Spread ideas." },
      {
        suggestTitle: 'MISSION Template 5',
        suggestText: "To connect the world's professionals to make them more productive and successful." },
      {
        suggestTitle: 'MISSION Template 6',
        suggestText: "To build the Web’s most convenient, secure, cost-effective payment solution." },
      {
        suggestTitle: 'MISSION Template 7',
        suggestText: "To give people the power to share and make the world more open and connected." },
      {
        suggestTitle: 'MISSION Template 8',
        suggestText: "To make it easy to do business anywhere." },
      {
        suggestTitle: 'MISSION Template 9',
        suggestText: "To give everyone the power to create and share ideas and information instantly, without barriers.</li><li>" },
      {
        suggestTitle: 'MISSION Template 10',
        suggestText: "Utilize the power of Moore’s Law to bring smart, connected devices to every person on earth." },
      {
        suggestTitle: 'MISSION Template 11',
        suggestText: "To enable economic growth through infrastructure and energy development, and to provide solutions that support communities and protect the planet." },
      {
        suggestTitle: 'VISSION Template 1',
        suggestText: "To become the global stimulation platform for national economies through a network of business gateways.",
      },
      {
        suggestTitle: 'VISSION Template 2',
        suggestText: "Our vision is to be earth’s most customer-centric company, where customers can find and discover anything they might want to buy online.",
      },
      {
        suggestTitle: 'VISSION Template 3',
        suggestText: "To be the company that best understands and satisfies the product, service, and self-fulfillment needs of women—globally.",
      },
      {
        suggestTitle: 'VISSION Template 4',
        suggestText: "Making the best ice cream in the nicest possible way",
      },
      {
        suggestTitle: 'VISSION Template 5',
        suggestText: "People working together as a lean, global enterprise to make people’s lives better through automotive and mobility leadership.",
      },
      {
        suggestTitle: 'VISSION Template 6',
        suggestText: "To be the world’s most successful and important information technology company. Successful in helping our customers apply technology to solve their problems. Successful in introducing this extraordinary technology to new customers. Important because we will continue to be the basic resource of much of what is invested in this industry.",
      },
      {
        suggestTitle: 'VISSION Template 7',
        suggestText: "To move with velocity to drive profitable growth and become an even better McDonald’s serving more customers delicious food each day around the world.",
      },
      {
        suggestTitle: 'VISSION Template 8',
        suggestText: "To serve our customers better, to always be relevant in their lives, and to form lifelong relationships.",
      },
      {
        suggestTitle: 'VISSION Template 9',
        suggestText: "To establish Starbucks as the premier purveyor of the finest coffee in the world while maintaining our uncompromising principles while we grow.",
      },
      {
        suggestTitle: 'VISSION Template 10',
        suggestText: "We believe that buying glasses should be easy and fun. It should leave you happy and good-looking, with money in your pocket. We also believe that everyone has the right to see.",
      },
      {
        suggestTitle: 'VISSION Template 11',
        suggestText: "To provide the best customer service possible. Deliver 'WOW' through service.",
      }
    ]  */
  }
  txtPreview(data) {
    this.previewHeading = data.suggestTitle;
    this.previewText = data.suggestText;
    this.addData = data;
  }
}
